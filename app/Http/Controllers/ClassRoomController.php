<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use Exception;
use Illuminate\Http\Request;

class ClassRoomController extends Controller
{
    public function index()
    {
        $classRoom = ClassRoom::all();
        return view('classes.index', compact('classRoom'));
    }

    public function create()
    {
        return view('classes.create');
    }

    public function store(Request $request)
    {
        try{
            $data = $request->all();  
            $image_url = $this->uploadImage($request['image']); 
            $data['image'] = $image_url;
            $data['created_by'] = 1;
            ClassRoom::create($data);

            return redirect()->route('class')->with('success', 'Tạo lớp học thành công');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Tạo lớp học không thành công');
        }
    }

    public function uploadImage($file) {
        if ($file) {
            $originName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();           
            $currentDateTime = now()->format('dmY_Hi');
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $fileName = $fileName . '_' . $currentDateTime . '.' . $extension;
            $path = $file->storeAs('public/images', $fileName);
            return asset('public/storage/images/' . $fileName);
        }
    }
}
