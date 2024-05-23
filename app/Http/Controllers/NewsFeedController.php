<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Comment;
use App\Models\NewsFeed;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NewsFeedController extends Controller
{
    public function index($id)
    {
        $newsFeeds = NewsFeed::with('author')->where('class_room_id', $id)->get();
        $newsComments = NewsFeed::with('author')->join('comments', 'comments.news_feed_id', '=', 'news_feeds.id')->get(); 
        return view('users.news.index', compact('newsFeeds', 'newsComments'));
    }

    public function store(Request $request){
        try{
            $newsFeed = $request->all(); 
            $newsFeed['created_by'] = auth()->user()->id;
            NewsFeed::create($newsFeed);

            return redirect()->back()->with('success', 'Đăng tin thành công');
        }catch(Exception $e){
            Log::info("Error: " . $e->getMessage());
            return redirect()->back()->with('error', 'Đăng tin thất bại');
        }
    }

    public function update(Request $request, $id){      
        try{
            $newsFeed = NewsFeed::find($id);
            if (!$newsFeed) {
                return redirect()->back()->with('error', 'Không tìm thấy bài đăng');
            }
            $newsFeedData = $request->all(); 
            $newsFeedData['created_by'] = auth()->user()->id;
            $newsFeedData['class_room_id'] = $newsFeed->class_room_id;
            
            $newsFeed->update($newsFeedData);

            return redirect()->back()->with('success', 'Cập nhật tin thành công');
        }catch(Exception $e){
            Log::info("Error: " . $e->getMessage());
            return redirect()->back()->with('error', 'Cập nhật tin thất bại');
        }
    }

    public function destroy($id){
        try{
            $newsFeed = NewsFeed::find($id);
            if (!$newsFeed) {
                return redirect()->back()->with('error', 'Không tìm thấy bài đăng');
            }
            $newsFeed->delete();
            return redirect()->back()->with('success', 'Xóa bài đăng thành công');
        }catch(Exception $e){
            Log::info("Error: " . $e->getMessage());
            return redirect()->back()->with('error', 'Xóa bài đăng thất bại');
        }
    }
}
