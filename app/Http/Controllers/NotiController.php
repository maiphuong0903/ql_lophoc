<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use function App\Helpers\createNotification;
use function App\Helpers\sendNotificationToUser;

class NotiController extends Controller
{
    public function store($id, Request $request){
        try{
            $classRoomId = $id;
            $created_by = auth()->user()->id;

            // tạo thông báo
            $notification = createNotification(null, $request->content, 1, $created_by, $classRoomId);

            // Lấy tất cả các thành viên trong lớp
            $classMembers = User::whereHas('classrooms', function ($query) use ($classRoomId) {
                $query->where('class_room_id', $classRoomId);
            })->where('id', '!=', $created_by)->pluck('id');

            // Gửi thông báo đến tất cả các thành viên trong lớp
            sendNotificationToUser($classMembers, $notification);

            return redirect()->back()->with('success', 'Tạo thông báo thành công');
        }catch(Exception $e){
            Log::info("ERROR: " . $e->getMessage());
            return redirect()->back()->with('error', 'Tạo thông báo thất bại');
        }      
    }

    public function destroy($classId, $notiId){
        try{
            $notification = Notification::find($notiId);
            if (!$notification) {
                return redirect()->back()->with('error', 'Thông báo không tồn tại');
            }
            $notification->delete();

            return redirect()->back()->with('success', 'Xóa thông báo thành công');
        }catch(Exception $e){
            Log::info("ERROR: " . $e->getMessage());
            return redirect()->back()->with('error', 'Xóa thông báo thất bại');
        }       
    }
}
