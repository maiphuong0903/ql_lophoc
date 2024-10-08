<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentRequest;
use App\Models\ClassRoom;
use App\Models\Document;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $classRoomId = $request->id;
        $documents = Document::filter($request->all())
                    ->where('class_room_id', $classRoomId)
                    ->whereHas('author', function ($query) use ($classRoomId) {
                        $query->whereHas('classRooms', function ($innerQuery) use ($classRoomId) {
                            $innerQuery->where('class_rooms.id', $classRoomId)
                                    ->where('role', 2); 
                        });
                    })
                    ->get();
        $classRooms = ClassRoom::where('created_by', auth()->user()->id)->get();
        
        return view('users.files.index', compact('documents', 'classRooms'));
    }

    public function show($id, $documentId)
    {
        $document = Document::find($documentId);
        $filePath = config('app.url') . '/storage/' . $document->document_url;

        return view('users.files.show', compact('filePath'));
    }
    public function store(StoreDocumentRequest $request, $id)
    {
        try {
            $document = $request->all();
            $document['created_by'] = auth()->user()->id;

            if ($request->document_url) {
                $document['document_url'] = $request->file('document_url')->store('pdfs', 'public');
            }

            $document['class_room_id'] = $id;
            Document::create($document);

            return redirect()->back()->with('success', 'Tạo tài liệu lên thành công');
        } catch (Exception $e) {
            Log::info("ERROR: " . $e->getMessage());
            return redirect()->back()->with('error', 'Tải tài liệu lên thất bại');
        }
    }

    public function destroy($id)
    {
        try {
            $document = Document::find($id);
            if (!$document) {
                return redirect()->back()->with('error', 'Không tìm thấy tài liệu');
            }
            $document->delete();
            return redirect()->back()->with('success', 'Xóa tài liệu thành công');
        } catch (Exception $e) {
            Log::info("Error: " . $e->getMessage());
            return redirect()->back()->with('error', 'Xóa tài liệu thất bại');
        }
    }

    public function shareFile(Request $request){
        try{
            $documentIds = json_decode($request->input('document_ids'));
            foreach ($documentIds as $documentId) {
                $document = Document::find($documentId);
    
                foreach ($request->input('class') as $classId) {
                    $existingDocument = Document::where('class_room_id', $classId)
                                                ->where('title', $document->title)
                                                ->first();
    
                    if ($existingDocument) {
                        $classRoom = ClassRoom::find($classId);
                        $errorMessage = "Tài liệu '{$document->title}' đã tồn tại trong lớp '{$classRoom->name}'.";
                        return redirect()->back()->with('error', $errorMessage);
                    } else {
                        // Tạo bản sao của tài liệu và gán mã lớp học mới
                        $newDocument = $document->replicate();
                        $newDocument->class_room_id = $classId;
                        $newDocument->save();
                    }
                }
            }

            return redirect()->back()->with('success', 'Chia sẻ tài liệu thành công');
        } catch(Exception $e) {
            Log::info("Error: " . $e->getMessage());
            return redirect()->back()->with('error', 'Chia sẻ tài liệu thất bại');
        }
    }
}
