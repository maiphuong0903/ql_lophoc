<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index()
    {
        return view('users.exams.index');
    }

    public function store(Request $request){
        dd($request->all());
    }
}
