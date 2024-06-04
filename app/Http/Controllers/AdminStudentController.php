<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminStudentController extends Controller
{
    public function index(Request $request){
        $students = User::filter($request->all())->where('role', 3)->paginate(10);

        return view('admin.students.index', compact('students'));
    }

    public function create(){
        return view('admin.students.create');
    }

    public function store(Request $request){
        try{
            $student = $request->all(); 
            $student['role'] = 3;
            $student['password'] = Hash::make('123456');
            User::create($student);

            return redirect()->route('admin.student')->with('success', 'Thêm học sinh thành công');
        }catch(Exception $e){
            Log::info("Error: " . $e->getMessage());
            return redirect()->route('admin.student')->with('error', 'Thêm học sinh thất bại');
        }
    }
    
    public function delete($id){
        try{
            $teacher = User::find($id);
            $teacher->delete();

            return redirect()->route('admin.student')->with('success', 'Xóa học sinh thành công');
        }catch(Exception $e){
            Log::info("Error: " . $e->getMessage());
            return redirect()->route('admin.student')->with('error', 'Xóa học sinh thất bại');
        }
    }
}
