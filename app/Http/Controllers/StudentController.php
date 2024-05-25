<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $student = ClassRoom::join('user_class_rooms', 'user_class_rooms.class_room_id', '=', 'class_rooms.id')->where('class_rooms.id', $request->id)->get();
        $students = User::join('user_class_rooms', 'user_class_rooms.user_id', '=', 'users.id')->where('user_class_rooms.class_room_id', $request->id)->where('users.deleted_at', NULL)->where('users.id', '!=', auth()->user()->id)->where('users.role', 3)->paginate(10);

        return view('users.members.index', compact('students'));
    }

    public function addStudent($id, Request $request)
    {
        $student = User::where('email', $request->input('email'))->first();
        
        $room = ClassRoom::find($id);

        if (!$student) {
           return redirect()->back()->with('error', 'Không tồn tại học sinh này');
        }
        dd($room->users()->where('user_id', $student->id)->get());
        if ($room->users()->where('user_id', $student->id)->exists()) {

            return redirect()->back()->with('error', 'Học sinh này đã tồn tại trong lớp');
        } 

        $room->users()->attach($student->id, ['content_role' => 'Học sinh lớp']);

        return redirect()->back()->with('success', 'Đã thêm học sinh này vào lớp');
    }

    public function deleteStudent($id, $studentId)
    {
        $room = ClassRoom::find($id);
        $student = User::find($studentId);
        $room->users()->detach($student);
        return redirect()->back()->with('success', 'Xóa học sinh viên trong lớp');
    }
}
