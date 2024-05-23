<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $documents = Document::filter($request->all())->where('created_by', auth()->user()->id)->get();
        return view('users.files.index', compact('documents'));
    }

    public function show($id, $documentId){  
        $document = Document::find($documentId);     
        $filePath = public_path($document->document_url);
        dd($filePath);
        if(!file_exists($filePath)) {
            return redirect()->back()->with('error', 'Tệp tài liệu không tồn tại');
        }
    
        $fileContent = file_get_contents($filePath);
        dd($fileContent);
        return view('users.files.show', compact('document', 'fileContent'));
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
