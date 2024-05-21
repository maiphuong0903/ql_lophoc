<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassRoomRequest;
use App\Models\ClassRoom;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ClassRoomController extends Controller
{
    public function index(Request $request)
    {      
        $classRoom = ClassRoom::filter($request->all())->where('created_by', auth()->user()->id)->get();
        return view('classes.index', compact('classRoom'));
    }

    public function create()
    {
        return view('classes.create');
    }

    public function store(ClassRoomRequest $request)
    {
        try{
            $classRoom = $request->all();
            $code = Str::random(6); 
          
            while (ClassRoom::where('code', strtoupper($code))->exists()) {
                $code = Str::random(6); 
            }
           
            $image_url = $this->uploadImage($request['image']);  
            $classRoom['code'] = strtoupper($code);
            $classRoom['image'] = $image_url;
            $classRoom['created_by'] = auth()->user()->id;
            
            ClassRoom::create($classRoom);

            return redirect()->route('class')->with('success', 'Tạo lớp học thành công');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Tạo lớp học không thành công');
        }
    }

    public function edit($id){
        $classRoom = ClassRoom::find($id);
        return view('classes.update', compact('classRoom'));
    }

    public function update(ClassRoomRequest $request, $id){
        try{
            $classRoom = ClassRoom::find($id);
            if (!$classRoom) {
                return redirect()->back()->with('error', 'Lớp học không tồn tại');
            }
            $classRoomData = $request->all(); 
            $image_url = $this->uploadImage($request['image']); 
            $classRoomData['image'] = $image_url;
            $classRoomData['created_by'] = auth()->user()->id;
            $classRoom->update($classRoomData);

            return redirect()->route('class')->with('success', 'Cập nhât lớp học thành công');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Cập nhật lớp học không thành công');
        }
    }

    public function destroy($id){
        try{        
            $classRoom = ClassRoom::find($id);          
            if (!$classRoom) {
                return redirect()->back()->with('error', 'Lớp học không tồn tại');
            }         
            $classRoom->delete();
            return redirect()->route('class')->with('success', 'Xóa lớp học thành công');
        }catch(Exception $e){
            Log::info("Error: " . $e->getMessage());
            return redirect()->back()->with('error', 'Xóa lớp học không thành công');
        }
    }

    public function uploadImage($file) {
        if ($file) {   
            $originName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();           
            $currentDateTime = now()->format('dmY_Hi');
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $fileName = $fileName . '_' . $currentDateTime . '.' . $extension;
            $file->storeAs('public/images', $fileName);
            return asset('storage/images/' . $fileName);
        }

        return null;
    }
}
