<?php

namespace App\Http\Controllers;

use App\Exports\StudentExport;
use App\Models\ClassRoom;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

use function App\Helpers\createNotification;
use function App\Helpers\sendNotificationToUser;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $classRoomId = $request->id;
        $classRoomCreatorId = ClassRoom::find($classRoomId)->created_by;
        $students = User::filter($request->all())->whereHas('classRooms', function ($query) use ($classRoomId) {
                        $query->where('class_rooms.id', $classRoomId)
                            ->where('user_class_rooms.content_role', 'Học sinh lớp')
                            ->where('user_class_rooms.status', 3);;
                    })
                    ->whereNull('deleted_at')
                    ->where('id', '!=', $classRoomCreatorId) 
                    ->paginate(10);
                
        $request->session()->put('search', $request->all());
        $students->appends($request->all());

        // Lấy tất cả các thông báo được gửi đến cho người dùng
        $user_id = auth()->user()->id;
        $listNoti = Notification::whereHas('users', function ($query) use ($user_id) {
            $query->where('user_id', $user_id)->where('type', 4);
        })->get();

        return view('users.members.index', compact('students', 'listNoti'));
    }

    public function addStudent($id, Request $request)
    {
        try{
            $classRoomId = $id;
            $student = User::where('email', $request->input('email'))->first();
            $room = ClassRoom::find($classRoomId);
    
            if (!$student) {
               return redirect()->back()->with('error', 'Không tồn tại học sinh này');
            }
            
            if ($room->users()->where('user_id', $student->id)->where('status', '2')->exists()) {
    
                return redirect()->back()->with('status', 'Học sinh này đã được gửi lời mời tham gia lớp học');
            } 

            $error_message = $student->role == 2 
            ? 'Người này đã tham gia là giáo viên của lớp' 
            : 'Học sinh này đã tồn tại trong lớp';
        
            if ($room->users()->where('user_id', $student->id)->where('status', '3')->exists()) {
                return redirect()->back()->with('error', $error_message);
            } 

            $room->users()->attach($student->id, [
                'content_role' => 'Học sinh lớp', 
                'status' => 3,
            ]);

            return redirect()->back()->with('success', 'Thêm học sinh vào lớp thành công');
        }catch(Exception $e){
            Log::info("ERROR: " . $e->getMessage());
            return redirect()->back()->with('error', 'Thêm học sinh vào lớp thất bại');
        }
    }

    public function deleteStudent($classId, $studentId)
    {
        try{
            $room = ClassRoom::find($classId);
            $student = User::find($studentId);
            $room->users()->detach($student);
            
            return redirect()->back()->with('success', 'Xóa học sinh khỏi lớp thành công');
        }catch(Exception $e){
            Log::info("Error: " . $e->getMessage());
            return redirect()->back()->with('error', 'Xóa học sinh khỏi lớp thất bại');
        }
    }

    public function exportStudent(Request $request){
        return Excel::download(new StudentExport($request),"student_" .  Carbon::now()->format('d:m:Y-H:i') . ".xlsx");
    }

    public function leaveClass($classId, $studentId){
        try{
            $room = ClassRoom::find($classId);
            
            $student = User::find($studentId);

            $room->users()->detach($student);

            return redirect()->route('class')->with('success', 'Rời khỏi lớp thành công');
        }catch(Exception $e){
            Log::info("Error: " . $e->getMessage());
            return redirect()->back()->with('error', 'Rời lớp thất bại');
        }
    }

    public function createAnswerHomeWork(Request $request, $homeworkId, $studentId){
        try{      
            $user = User::with('classRooms')->find($studentId);
            $classRoomId = $user->classRooms->first()->id;
            $answer = [
                'user_id' => $studentId,
                'home_work_id' => $homeworkId,
                'answer' => $request->input('answer'), 
            ];
    
            $user->answerHomeworks()->attach($homeworkId, $answer);
            
           return redirect()->route('class.homework', $classRoomId)->with('success', 'Nộp bài thành công');
        }catch(Exception $e){
            Log::info("Error: " . $e->getMessage());
            return redirect()->back()->with('error', 'Nộp bài thất bại');
        }
    }
}
