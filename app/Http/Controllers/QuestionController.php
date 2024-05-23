<?php

namespace App\Http\Controllers;

use App\Models\AnswerQuestion;
use Illuminate\Http\Request;
use App\Models\Question;
use Exception;
use Illuminate\Support\Facades\Log;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $questions = Question::with('answers')->filter($request->all())->where('created_by', auth()->user()->id)->get();
        return view('users.questions.index', compact('questions'));
    }

    public function store(Request $request){
        try{
            $question = Question::create([
                'content' => $request['content'],
                'topic_id' => $request['topic_id'],
                'created_by' => auth()->user()->id,
            ]);
            
            // Tạo các đáp án
            foreach ($request['answer_content'] as $index => $answerData) {
                AnswerQuestion::create([
                    'question_id' => $question->id,
                    'answer_content' => $answerData,
                    'is_correct' => ($index + 1) == $request['is_correct'],
                ]);    
            }

            return redirect()->back()->with('success', 'Tạo câu hỏi thành công');
        }catch(Exception $e){
            Log::info("ERROR: " . $e->getMessage());
            return redirect()->back()->with('error', 'Tạo câu hỏi thất bại');
        }
    }

    public function update(Request $request, $id){
        try{
            $question = Question::find($id);
            if (!$question) {
                return redirect()->back()->with('error', 'Không tìm thể câu hỏi');
            }
             $questionData['created_by'] = auth()->user()->id;

            $question->update($request->all());
            return redirect()->back()->with('success', 'Cập nhật câu hỏi lại');
        }catch(Exception $e){
            Log::info("Error: " . $e->getMessage());
            return redirect()->back()->with('error', 'Cập nhật câu hỏi thất bại');
        }
    }

    public function destroy($id){
        try{
            $question = Question::find($id);
            if (!$question) {
                return redirect()->back()->with('error', 'Không tìm thấy câu hỏi');
            }
            $question->delete();
            return redirect()->back()->with('success', 'Xóa câu hỏi thành công');
        }catch(Exception $e){
            Log::info("Error: " . $e->getMessage());
            return redirect()->back()->with('error', 'Xóa câu hỏi thất bại');
        }
    }
}
