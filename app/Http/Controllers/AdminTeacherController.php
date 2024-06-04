<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminTeacherController extends Controller
{
    public function index(Request $request){
        $teachers = User::filter($request->all())->where('role', 2)->paginate(10);

        return view('admin.teachers.index', compact('teachers'));
    }

    public function create(){
        return view('admin.teachers.create');
    }

    public function store(Request $request){
        try{
            $teacher = $request->all(); 
            $teacher['role'] = 2;
            $teacher['password'] = Hash::make('123456');
            User::create($teacher);

            return redirect()->route('admin.teacher')->with('success', 'Tạo giáo viên thành công');
        }catch(Exception $e){
            Log::info("Error: " . $e->getMessage());
            return redirect()->route('admin.teacher')->with('error', 'Tạo giáo viên thất bại');
        }
    }

    public function edit($id){
        $teacher = User::find($id);

        return view('admin.teachers.update', compact('teacher'));
    }

    public function update(Request $request, $id){
        try{
            $teacher = User::find($id);
            $teacherData = $request->all();
            $teacher->update($teacherData);

            return redirect()->route('admin.teacher')->with('success', 'Cập nhật giáo viên thành công');
        }catch(Exception $e){
            Log::info("Error: " . $e->getMessage());
            return redirect()->route('admin.teacher')->with('error', 'Xóa giáo viên thất bại');
        }
    }

    public function delete($id){
        try{
            $teacher = User::find($id);
            $teacher->delete();

            return redirect()->route('admin.teacher')->with('success', 'Xóa giáo viên thành công');
        }catch(Exception $e){
            Log::info("Error: " . $e->getMessage());
            return redirect()->route('admin.teacher')->with('error', 'Xóa giáo viên thất bại');
        }
    }
}
