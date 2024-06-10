<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {     
        $teachers = User::where('role', 2)->count();
        $students = User::where('role', 3)->count();
        $classrooms = User::where('role', 1)->count();

        $data = [
            'teachers' => $teachers,
            'students' => $students,
            'classrooms' => $classrooms
        ];

        return view('dashboard', $data);
    }
}
