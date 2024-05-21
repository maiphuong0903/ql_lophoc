<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index($id)
    {
        $classRoom = ClassRoom::find($id);
        return view('users.members.index', compact('classRoom'));
    }

   public function addStudent(Request $request){
        
   }
}
