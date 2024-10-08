<?php

namespace App\Http\Controllers;

use App\Exports\TeacherExport;
use App\Models\ClassRoom;
use App\Models\Document;
use App\Models\Exam;
use App\Models\HomeWork;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

use function App\Helpers\createNotification;
use function App\Helpers\sendNotificationToUser;

class ClassRoleController extends Controller
{
    public function index(Request $request)
    {
        $classRoomId = $request->id;
        $teachersQuery = User::filter($request->all())->whereHas('classRooms', function ($query) use ($classRoomId) {
            $query->where('class_rooms.id', $classRoomId)
                  ->where('user_class_rooms.content_role', '!=', 'Học sinh lớp')
                  ->where('user_class_rooms.status', 3);
        })
        ->whereNull('deleted_at')
        ->where('role', 2);

        // lấy ra người tạo ra lớp này
        $creatorQuery = User::whereHas('created_by_class_room', function ($query) use ($classRoomId) {
            $query->where('class_rooms.id', $classRoomId);
        });

        // lấy ra tất cả giáo viên trong lớp và người tạo ra lớp này
        $teachers = $teachersQuery->unionAll($creatorQuery)
        ->orderBy('created_at') 
        ->paginate(10);
        
        $request->session()->put('search', $request->all());
        $teachers->appends($request->all());  

        
        $totalDocuments = [];
        $totalHomeWork = [];
        $totalExam = [];
        foreach ($teachers as $teacher) {
            // lấy ra số lượng tài liệu giáo viên đã tạo trong lớp
            $documentsCount = Document::whereHas('author', function ($query) use ($teacher) {
                $query->where('id', $teacher->id)
                ->where('role', '2');
            })->where('class_room_id', $classRoomId)->count();
        
            // lấy ra số lượng bài tập giáo viên đã tạo trong lớp
            $homeWorkCount = HomeWork::whereHas('author', function ($query)  use ($teacher) {
                $query->where('id', $teacher->id)
                ->where('role', '2');
            })->where('class_room_id', $classRoomId)->count();

            // lấy ra số lượng bài kiểm tra giáo viên đã tạo trong lớp
            $examCount = Exam::whereHas('author', function ($query)  use ($teacher) {
                $query->where('id', $teacher->id)
                ->where('role', '2');
            })->where('class_room_id', $classRoomId)->count();

            $totalDocuments[$teacher->id] = $documentsCount;
            $totalHomeWork[$teacher->id] = $homeWorkCount;
            $totalExam[$teacher->id] = $examCount;
        }

        return view('users.class-roles.index', compact('teachers', 'totalDocuments', 'totalHomeWork', 'totalExam'));
    }

    public function addTeacher($id, Request $request){
        try{
            $classRoomId = $id;
            $teacher = User::where('email', $request->input('email'))->first();
            $contentRole = $request->input('content_role');
            $room = ClassRoom::find($classRoomId);
    
            if (!$teacher) {
               return redirect()->back()->with('error', 'Không tồn tại giáo viên này');
            }
            // Kiểm tra vai trò của người dùng
            if ($teacher->role == 1 && $teacher->role == 3) {
                return redirect()->back()->with('error', 'Người này không phải giáo viên');
            }

            if ($room->users()->where('user_id', $teacher->id)->where('status', '2')->exists()) {
    
                return redirect()->back()->with('status', 'Giáo viên này đã được gửi lời mời tham gia lớp học');
            } 

            if ($room->users()->where('user_id', $teacher->id)->where('status', '3')->exists()) {
    
                return redirect()->back()->with('error', 'Giáo viên này đã tồn tại trong lớp');
            } 
    
            // gửi lời mời tham gia vào lớp cho giáo viên
            $room->users()->attach($teacher->id, [
                'content_role' => $contentRole, 
                'status' => 2,
            ]);
            
            // tạo thông báo cho giáo viên đó
            $contentNoti = 'Giáo viên ' . auth()->user()->name . ' mời bạn làm giáo viên đồng hành của lớp ' . $room->name;
            $created_by = auth()->user()->id;
            $notification = createNotification(null, $contentNoti, 3, $created_by, $classRoomId);

            // gửi thông báo cho giáo viên đó
            sendNotificationToUser([$teacher->id], $notification);

            return redirect()->back()->with('success', 'Đã gửi lời mởi cho giáo viên thành công');
        }catch(Exception $e){
            log::info("Error: " . $e->getMessage());
            return redirect()->back()->with('error', 'Gửi lời mởi cho giáo viên thất bại');
        }
    }

    public function acceptJoinClass($id, $userId, $notiId){
        $classRoom = ClassRoom::find($id);

        // cập nhật status thành đồng ý tham gia lớp
        $classRoom->users()->updateExistingPivot($userId, ['status' => 3]);

        // cập nhật trang thái thông báo tham gia lớp
        Notification::where('id', $notiId)
                    ->update(['is_accept' => 1]);

        return redirect()->back()->with('success', 'Tham gia lớp học thành công');
    }

    public function rejectJoinClass($id, $userId, $notiId)
    {
        try{
            $classRoom = ClassRoom::find($id);    
            $user = User::find($userId);
            
            // xóa giáo viên này khỏi lớp
            $classRoom->users()->detach($user);

             // cập nhật trang thái thông báo tham gia lớp
            Notification::where('id', $notiId)
                        ->update(['is_accept' => 1]);

            return redirect()->back()->with('success', 'Đã từ chối tham gia lớp thành công');
        }catch(Exception $e){
            Log::info("Error: " . $e->getMessage());
            return redirect()->back()->with('error', 'Từ chối tham gia lớp thất bại');
        }
    }

    public function deleteTeacher($id, $teacherId)
    {
        try{
            $room = ClassRoom::find($id);    
            $teacher = User::find($teacherId);
            $room->users()->detach($teacher);
            
            return redirect()->back()->with('success', 'Xóa giáo viên khỏi lớp thành công');
        }catch(Exception $e){
            Log::info("Error: " . $e->getMessage());
            return redirect()->back()->with('error', 'Xóa giáo viên khỏi lớp thất bại');
        }
    }

    public function exportTeacher(Request $request){
        return Excel::download(new TeacherExport($request),"teacher_" .  Carbon::now()->format('d:m:Y-H:i') . ".xlsx");
    }
}
