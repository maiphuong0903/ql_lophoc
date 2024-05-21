<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function store(Request $request){
        try{
            $comment = $request->all();
            $comment['user_id'] = auth()->user()->id;
            Comment::create($comment);
            
            return redirect()->back()->with('success', 'Đăng bình luận thành công');
        }catch(Exception $e){
            Log::info("Error: " . $e->getMessage());
            return redirect()->back()->with('error', 'Đăng bình luận thất bại');
        }
    }

    public function destroy($id){
        try{
            $comment = Comment::find($id);
            if (!$comment) {
                return redirect()->back()->with('error', 'Không tìm thấy bình luận');
            }
            $comment->delete();
            return redirect()->back()->with('success', 'Xóa bình luận thành công');
        }catch(Exception $e){
            Log::info("Error: " . $e->getMessage());
            return redirect()->back()->with('error', 'Xóa bình luận thất bại');
        }
    }
}
