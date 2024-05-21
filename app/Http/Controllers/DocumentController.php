<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Document;
use App\Models\Topic;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DocumentController extends Controller
{
    public function index($id)
    {
        $classRoom = ClassRoom::find($id);
        $topics = Topic::where('class_room_id', $id)->get();
        $documents = Document::all();
        return view('users.files.index', compact('classRoom', 'topics', 'documents'));
    }

    public function show($id){
        $document = Document::find($id);
        return view('users.files.show', compact('document'));
    }
    public function store(Request $request)
    {
        try{
            $document = $request->all();
            $document['created_by'] = auth()->user()->id;

            Document::create($document);

            return redirect()->back()->with('success', 'Tạo tài liệu lên thành công');
        }catch(Exception $e){
            Log::info("ERROR: " . $e->getMessage());
            return redirect()->back()->with('error', 'Tải tài liệu lên thất bại');
        }
        
    }

    public function destroy($id){
        try{
            $document = Document::find($id);
            if (!$document) {
                return redirect()->back()->with('error', 'Không tìm thấy tài liệu');
            }
            $document->delete();
            return redirect()->back()->with('success', 'Xóa tài liệu thành công');
        }catch(Exception $e){
            Log::info("Error: " . $e->getMessage());
            return redirect()->back()->with('error', 'Xóa tài liệu thất bại');
        }
    }
}
