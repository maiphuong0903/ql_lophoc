<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $teachers = User::where('role', 2)->count();
        $students = User::where('role', 3)->count();
        $classrooms = ClassRoom::count();

        $classes = ClassRoom::all();
        $classNames = $classes->pluck('name'); 
        $studentCounts = $classes->map(function ($class) {
            return $class->users->count(); 
        });

        $data = [
            'teachers' => $teachers,
            'students' => $students,
            'classrooms' => $classrooms,
            'classNames' => $classNames,
            'studentCounts' => $studentCounts
        ];

        return view('dashboard', $data);
    }
}
