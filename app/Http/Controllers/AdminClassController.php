<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use Illuminate\Http\Request;

class AdminClassController extends Controller
{
    public function index(Request $request){
        $classRooms = ClassRoom::filter($request->all())->paginate(10);

        return view('admin.classes.index', compact('classRooms'));
    }

   
}
