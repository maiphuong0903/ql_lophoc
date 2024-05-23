<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index($id)
    {
        $room = ClassRoom::find($id)->with('users')->first();
        return view('users.members.index', compact('room'));
    }

    public function addStudent($id, Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        $room = ClassRoom::find($id);

        if (!$user) {
            //thong bao user ko ton tai
        }

        if ($room->users()->where('user_id', $user->id)->exists()) {
            echo "User đã tồn tại trong phòng.";
        } else {
            $room->users()->attach($user);
            echo "User đã được thêm vào phòng.";
        }
    }
}
