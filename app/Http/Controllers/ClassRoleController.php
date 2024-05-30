<?php

namespace App\Http\Controllers;

use App\Exports\StudentExport;
use App\Exports\TeacherExport;
use App\Models\ClassRoom;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ClassRoleController extends Controller
{
    public function index(Request $request)
    {
        $classRoomId = $request->id;
        $teachers = User::filter($request->all())->whereHas('classRooms', function ($query) use ($classRoomId) {
                        $query->where('class_rooms.id', $classRoomId)
                            ->where('user_class_rooms.content_role', '!=', 'Học sinh lớp');
                    })
                    ->whereNull('deleted_at')
                    ->where('role', 2)
                    ->paginate(10);

        $request->session()->put('search', $request->all());
        $teachers->appends($request->all());

        return view('users.class-roles.index', compact('teachers'));
    }

    public function addTeacher ($id, Request $request){
        try{
            $teacher = User::where('email', $request->input('email'))->first();
            $contentRole = $request->input('content_role');
            $room = ClassRoom::find($id);
    
            if (!$teacher) {
               return redirect()->back()->with('error', 'Không tồn tại giáo viên này');
            }
    
            if ($room->users()->where('user_id', $teacher->id)->exists()) {
    
                return redirect()->back()->with('error', 'Giáo viên này đã tồn tại trong lớp');
            } 
    
            $room->users()->attach($teacher->id, ['content_role' => $contentRole]);
    
            return redirect()->back()->with('success', 'Đã gửi lời mởi cho giáo viên thành công');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Gửi lời mởi cho giáo viên thất bại');
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
