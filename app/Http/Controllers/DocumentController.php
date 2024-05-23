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

    public function show($id, $documentId)
    {
        $document = Document::find($documentId);
        $filePath = config('app.url') . '/storage/' . $document->document_url;

        return view('users.files.show', compact('filePath'));
    }
    public function store(Request $request)
    {
        try {
            $document = $request->all();
            $document['created_by'] = auth()->user()->id;

            if ($request->document_url) {
                $document['document_url'] = $request->file('document_url')->store('pdfs', 'public');
            }

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
}
