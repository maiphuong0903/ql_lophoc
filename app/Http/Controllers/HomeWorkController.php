<?php

namespace App\Http\Controllers;

use App\Models\HomeWork;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeWorkController extends Controller
{
    public function index(Request $request)
    {
        $homeworks = HomeWork::filter($request->all())->where('created_by', auth()->user()->id)->get();
        return view('users.homework.index', compact('homeworks'));
    }

    public function create(){
        return view('users.homework.create');
    }

    public function store(Request $request){
        try{
                $homework = $request->all();

            // if ($request->hasFile('homework_file')) {
            //     $file = $request->file('homework_file');
            //     $path = $file->store('public/images');
            //     $url = Storage::url($path);
            //     $homework['homework_file'] = $url;
            // }
        
            $homework['created_by'] = auth()->user()->id; 
            HomeWork::create($homework);
            
            return redirect()->route('class.homework', $request->class_room_id )->with('success', 'Tạo bài tập lên thành công');
        }catch(Exception $e){
            Log::info("ERROR: " . $e->getMessage());
            return redirect()->back()->with('error', 'Tạo bài tập lên thất bại');
        }
    }           

    public function edit($classId, $homeworkId){
        $homework = HomeWork::find($homeworkId);
        
        return view('users.homework.edit', compact('homework'));
    }

    public function update(Request $request, $classId, $homeworkId){
        try{
            $homework = HomeWork::find($homeworkId);
            if (!$homework) {
                return redirect()->back()->with('error', 'Không tìm thấy bài tập');
            }
            $homeworkData = $request->all();
            $homeworkData['created_by'] = auth()->user()->id;
            $homework->update($homeworkData);

            return redirect()->route('class.homework', $request->class_room_id )->with('success', 'Cập nhật bài tập lên thành công');
        }catch(Exception $e){
            Log::info("Error: " . $e->getMessage());
            return redirect()->route('class.homework', $request->class_room_id )->with('error', 'Cập nhật bài tập lên thất bại');
        }
    }

    public function destroy($id){
        try{
            $homework = HomeWork::find($id);
            if (!$homework) {
                return redirect()->back()->with('error', 'Không tìm thấy bài tập');
            }
            $homework->delete();
            return redirect()->back()->with('success', 'Xóa bài tập thành công');
        }catch(Exception $e){
            Log::info("Error: " . $e->getMessage());
            return redirect()->back()->with('error', 'Xóa bài tập thất bại');
        }
    }
}
