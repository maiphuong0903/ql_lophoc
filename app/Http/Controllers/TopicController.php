<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TopicController extends Controller
{
    public function store(Request $request){
        try{
            $topic = $request->all();
            $topic['created_by'] = auth()->user()->id;     
            Topic::create($topic);

            return redirect()->back()->with('success', 'Tạo chủ đề thành công');
        }catch(Exception $e){
            Log::info("ERROR: ".$e->getMessage());
            return redirect()->back()->with('error', 'Tạo chủ đề thất bại');
        }
    }

    public function update(Request $request, $id){
        try{
            $topic = Topic::find($id);
            if (!$topic) {
                return redirect()->back()->with('error', 'Chủ đề không tồn tại');
            }
            $topicData = $request->all();
            $topicData['created_by'] = auth()->user()->id;
            $topicData['class_room_id'] = $topic->class_room_id;
            $topic->update($topicData);

            return redirect()->back()->with('success', 'Đổi tên chủ đề thành công');   
        }catch(Exception $e){
            Log::info("ERROR: ".$e->getMessage());
            return redirect()->back()->with('error', 'Đổi tên chủ đề thất bại');
        }
    }

    public function destroy($id){
        try{
            $topic = Topic::find($id);
            if (!$topic) {
                return redirect()->back()->with('error', 'Chủ đề không tồn tại');
            }
            $topic->delete();
            
            return redirect()->back()->with('success', 'Xóa chủ đề thành công');
        }catch(Exception $e){
            Log::info("ERROR: ".$e->getMessage());
            return redirect()->back()->with('error', 'Xóa chủ đề thát bị');
        }
    }
}
