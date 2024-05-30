<?php

namespace App\Http\Controllers;

use App\Exports\StudentExport;
use App\Models\ClassRoom;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $classRoomId = $request->id;
        $classRoomCreatorId = ClassRoom::find($classRoomId)->created_by;
        $students = User::filter($request->all())->whereHas('classRooms', function ($query) use ($classRoomId) {
                        $query->where('class_rooms.id', $classRoomId)
                            ->where('user_class_rooms.content_role', 'Học sinh lớp');
                    })
                    ->whereNull('deleted_at')
                    ->where('id', '!=', $classRoomCreatorId) 
                    ->paginate(10);
                
        $request->session()->put('search', $request->all());
        $students->appends($request->all());
        return view('users.members.index', compact('students'));
    }

    public function addStudent($id, Request $request)
    {
        try{
            $student = User::where('email', $request->input('email'))->first();
            $room = ClassRoom::find($id);
    
            if (!$student) {
               return redirect()->back()->with('error', 'Không tồn tại học sinh này');
            }
            
            $error_message = $student->role == 2 
            ? 'Người này đã tham gia là giáo viên của lớp' 
            : 'Học sinh này đã tồn tại trong lớp';
        
            if ($room->users()->where('user_id', $student->id)->exists()) {
                return redirect()->back()->with('error', $error_message);
            } 
    
            $room->users()->attach($student->id, ['content_role' => 'Học sinh lớp']);
    
            return redirect()->back()->with('success', 'Đã thêm học sinh này vào lớp');
        }catch(Exception $e){
            Log::info("ERROR: " . $e->getMessage());
            return redirect()->back()->with('error', 'Thêm học sinh này thất bại');
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
