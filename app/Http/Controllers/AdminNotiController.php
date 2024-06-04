<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminNotiController extends Controller
{
    public function index()
    {
        $notis = Notification::where('type', 2)->paginate(10);

        return view('admin.notis.index', compact('notis'));
    }

    public function updateSatusNoti($id){
        $noti = Notification::find($id);
        $notiData['is_accept'] = 1;
        $noti->update($notiData);

        return response()->json(['success' => true, 'message' => 'Thông báo đã được đọc']);
    }

    public function delete($id){
        try{
            $teacher = Notification::find($id);
            $teacher->delete();

            return redirect()->route('admin.noti')->with('success', 'Xóa thông báo thành công');
        }catch(Exception $e){
            Log::info("Error: " . $e->getMessage());
            return redirect()->route('admin.noti')->with('error', 'Xóa thông báo thất bại');
        }
    }
}
