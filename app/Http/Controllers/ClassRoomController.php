<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassRoomRequest;
use App\Models\ClassRoom;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ClassRoomController extends Controller
{
    public function index(Request $request)
    {      
        $userId = auth()->user()->id;
        $classRoom = ClassRoom::filter($request->all())
                    ->where(function ($query) use ($userId) {
                        $query->where('created_by', $userId)
                            ->orWhereHas('users', function ($query) use ($userId) {
                            $query->where('user_id', $userId)
                                    ->where('status', 3);
                        });
                    })
                    ->get();
      
        return view('classes.index', compact('classRoom'));
    }

    public function create()
    {
        return view('classes.create');
    }

    public function store(ClassRoomRequest $request)
    {
        try{
            $code = Str::random(6); 
          
            while (ClassRoom::where('code', strtoupper($code))->exists()) {
                $code = Str::random(6); 
            }
           
            $image_url = $this->uploadImage($request['image']);  
            $classRoom = ClassRoom::create([
                'code' => strtoupper($code),
                'name' => $request['name'],
                'description' => $request['description'],
                'image' => $image_url,
                'created_by' => auth()->user()->id,
            ]);

            $classRoom->users()->attach(auth()->user()->id, ['content_role' => 'Chủ sở hữu']);

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

    public function joinClassRoom(){
        return view('classes.join-class');
    }

    public function joinClassRoomStore(Request $request){
       $classRoom = ClassRoom::where('code', $request->code)->first();

        if (!$classRoom) {
           return redirect()->back()->with('error', 'Không tồn tại lớp học này');
        }

        $student = User::find(auth()->user()->id);
       
        if ($classRoom->users()->where('user_id', $student->id)->exists()) {

            return redirect()->route('class')->with('error', 'Bạn đã tham gia lớp học này');
        } 

        $classRoom->users()->attach($student->id, ['content_role' => 'Học sinh lớp']);

        return redirect()->route('class')->with('success', 'Tham gia lớp học thành công');
        
    }
}
