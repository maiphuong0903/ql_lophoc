<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\User;
use Illuminate\Http\Request;

class ClassRoleController extends Controller
{
    public function index()
    {
        return view('users.class-roles.index');
    }

    public function addTeacher ($id, Request $request){
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

        return redirect()->back()->with('success', 'Đã gửi lời mởi cho giáo viên');
    }
}
