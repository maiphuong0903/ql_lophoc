<?php

namespace App\Http\Controllers;

use App\Models\AnswerQuestion;
use App\Models\Exam;
use Illuminate\Http\Request;
use App\Models\Question;
use Exception;
use Illuminate\Support\Facades\DB;
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
            DB::beginTransaction();
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
                    'answer_index' => $request['answer_index'][$index],
                ]);   
            }
            
            DB::commit();
            return redirect()->back()->with('success', 'Tạo câu hỏi thành công');
        }catch(Exception $e){
            DB::rollBack();
            Log::info("ERROR: " . $e->getMessage());
            return redirect()->back()->with('error', 'Tạo câu hỏi thất bại');
        }
    }

    public function edit($id, $questionId){
        $question = Question::findOrFail($questionId);
        $answers = AnswerQuestion::where('question_id', $questionId)->get();

        return view('users.questions.edit', compact('question', 'answers'));
    }

    public function update(Request $request, $id, $questionId){
        try{
         
            $question = Question::find($questionId);
            $exams = $question->exams;

            if ($exams->isNotEmpty()) {
                $examNames = $exams->pluck('title')->join(', ');
             
                $message = "Câu hỏi này đã tồn tại trong bài kiểm tra: $examNames. Vui lòng không chỉnh sửa.";
                return redirect()->back()->with('status', $message);
            }

            // Lấy danh sách các đáp án hiện tại của câu hỏi
            $currentAnswers = AnswerQuestion::where('question_id', $question->id)->get()->keyBy('id');

            // Tạo hoặc cập nhật các đáp án
            foreach ($request['answer_content'] as $index => $answerData) {
                $answerId = $request['answer_id'][$index] ?? null;
                $isCorrect = $request['is_correct'] == $index ? 1 : 0;
                if ($answerId && $currentAnswers->has($answerId)) {
                    // Cập nhật đáp án hiện có
                    $currentAnswers[$answerId]->update([
                        'answer_content' => $answerData,
                        'is_correct' => $isCorrect,
                        'answer_index' => $request['answer_index'][$index],
                    ]);
                    // Xóa khỏi danh sách cần xóa
                    $currentAnswers->forget($answerId);
                } else {
                    // Tạo đáp án mới
                    AnswerQuestion::create([
                        'question_id' => $question->id,
                        'answer_content' => $answerData,
                        'is_correct' => $isCorrect,
                        'answer_index' => $request['answer_index'][$index],
                    ]);
                }
            }

            // Xóa các đáp án không còn trong yêu cầu cập nhật
            if ($currentAnswers->isNotEmpty()) {
                AnswerQuestion::whereIn('id', $currentAnswers->keys())->delete();
            }
            
            return redirect()->route('class.questions', $id)->with('success', 'Cập nhật câu hỏi thành công');
        }catch(Exception $e){
            Log::info("Error: " . $e->getMessage());
            return redirect()->back()->with('error', 'Cập nhật câu hỏi thất bại');
        }
    }
     

    public function destroy($id){
        try{
            $question = Question::find($id);
            $exams = $question->exams;
            if (!$question) {
                return redirect()->back()->with('error', 'Không tìm thấy câu hỏi');
            }

            if ($exams->isNotEmpty()) {
                $examNames = $exams->pluck('title')->join(', ');
             
                $message = "Câu hỏi này đã tồn tại trong bài kiểm tra: $examNames. Vui lòng không xóa.";
                return redirect()->back()->with('error', $message);
            }

            $question->delete();
            return redirect()->back()->with('success', 'Xóa câu hỏi thành công');
        }catch(Exception $e){
            Log::info("Error: " . $e->getMessage());
            return redirect()->back()->with('error', 'Xóa câu hỏi thất bại');
        }
    }
}
