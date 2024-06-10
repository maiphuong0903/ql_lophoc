<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassRoomRequest;
use App\Models\ClassRoom;
use App\Models\Notification;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

use function App\Helpers\createNotification;
use function App\Helpers\sendNotificationToUser;

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

            // tạo thông báo 
            $title = 'Bạn có 1 thông báo mới';
            $content = 'Giáo viên ' . auth()->user()->name . ' đã tạo 1 lớp học tên là ' . $classRoom->name;
            $created_by = auth()->user()->id;

            $notification = createNotification($title, $content, 2, $created_by);

            // gửi thông báo cho tất cả tài khoản admin
            $admin = User::where('role', '1');

            sendNotificationToUser($admin, $notification);
            
            return redirect()->route('class')->with('success', 'Tạo lớp học thành công');
        }catch(Exception $e){
            Log::info("Error: " . $e->getMessage());
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

        if ($classRoom->users()->where('user_id', $student->id)->where('status', '1')->exists()) {

            return redirect()->route('class')->with('status', 'Bạn đã gửi lời mời tham gia lớp học này');
        } 

        if ($classRoom->users()->where('user_id', $student->id)->where('status', '3')->exists()) {

            return redirect()->route('class')->with('error', 'Bạn đã tham gia lớp này');
        } 

        // gửi lời mời muốn tham gia vào lớp cho giáo viên
        $classRoom->users()->attach($student->id, [
            'content_role' => 'Học sinh lớp', 
            'status' => 1,
        ]);

         // tạo thông báo gửi cho giáo viên lớp đó
         $contentNoti = '<strong>' . $student->name . '</strong> muốn tham gia lớp của bạn';
         $created_by = auth()->user()->id;
         $classRoomId = $classRoom->id;
         $notification = createNotification(null, $contentNoti, 4, $created_by, $classRoomId);

         // gửi thông báo cho giáo viên đó
         $teacher = ClassRoom::find($classRoomId, ['created_by']);
        sendNotificationToUser([$teacher->created_by], $notification);

        return redirect()->route('class')->with('success', 'Gửi lời mời tham gia lớp học thành công');  
    }

    public function joinClassRoomUpdate(Request $request){
        $action = $request->input('action');
        $userIds = $request->input('user_ids');
        $notiIds = $request->input('noti_ids');
        // Lấy danh sách các thông báo cùng với lớp học tương ứng
        $notifications = Notification::whereIn('id', $notiIds)->get();
        if($action == 'accept'){
            foreach ($notifications as $notification) {
                $studentId = $notification->created_by;
                $classRoomId = $notification->class_room_id;
                $classRoom = ClassRoom::find($classRoomId);

                // Cập nhật trạng thái chấp nhận
                $classRoom->users()->updateExistingPivot($studentId, ['status' => 3]);
    
                // Cập nhật trạng thái thông báo thành đã chấp nhận hoặc từ chối
                $notification->update(['is_accept' => 1]);
            }
        }else if ($action == 'reject') {
            foreach ($userIds as $userId) {
                foreach ($notifications as $notification) {
                    $studentId = $notification->created_by;
                    $classRoomId = $notification->class_room_id;
                    $classRoom = ClassRoom::find($classRoomId);

                    // xóa user đó khỏi lớp
                    $classRoom->users()->detach($userId);
        
                    // Cập nhật trạng thái thông báo thành đã chấp nhận hoặc từ chối
                    $notification->update(['is_accept' => 1]);
                }
            }
        }

        return response()->json(['success' => true, 'message' => 'Thành công']);
    }
}
