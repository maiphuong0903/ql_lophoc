<?php

namespace App\Http\Controllers;

use App\Exports\ExamExport;
use App\Models\AnswerQuestion;
use App\Models\ClassRoom;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Topic;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ExamController extends Controller
{
    public function index($id, Request $request)
    {
        $classRoomId = $id;
        $exams = Exam::filter($request->all())->where('class_room_id', $classRoomId)->paginate(10);
        // Lấy tổng số học sinh trong lớp
        $totalStudents = User::whereHas('classRooms', function ($query) use ($classRoomId) {
            $query->where('role', '3')
                ->where('user_class_rooms.class_room_id', $classRoomId);
            })->count();

        // lấy tổng số học sinh đã làm bài kiểm tra 
        $submittedCounts = [];
        $isSubmitted = [];
        foreach ($exams as $exam) {
            $submittedCount = User::join('users_answers_exams', 'users.id', '=', 'users_answers_exams.user_id')
                            ->where('users_answers_exams.exam_id', $exam->id)
                            ->whereHas('classRooms', function ($query) use ($classRoomId) {
                                $query->where('role', '3')
                                    ->where('user_class_rooms.class_room_id', $classRoomId);
                            })
                            ->selectRaw('COUNT(DISTINCT users_answers_exams.user_id) as count_submit')
                            ->groupBy('users_answers_exams.exam_id', 'users_answers_exams.user_id')
                            ->value('count_submit');

            $submittedCounts[$exam->id] = $submittedCount;
            $isSubmitted[$exam->id] = $exam->hasSubmittedByUser(auth()->user()->id);
        }

        return view('users.exams.index', compact('exams', 'totalStudents', 'submittedCounts', 'isSubmitted'));
    }

    // tạo bài kiểm tra
    public function create($id){
        $listTopic = Topic::has('questions')
                        ->with('questions')
                        ->get();
           
        return view('users.exams.create', compact('listTopic'));
    }

    public function store($id, Request $request){
        try{
            $classRoomId = $id;
            $exam = Exam::create([
                'title' => $request->title,
                'time' => $request->time,
                'expiration_date' => $request->expiration_date,
                'created_by' => auth()->user()->id,
                'class_room_id' => $classRoomId
            ]);
    
            if ($request->has('questions')) {
                $exam->questions()->attach($request->questions);
            }
    
            return redirect()->route('class.exams', $classRoomId)->with('success', 'Tạo bài kiểm tra thành công');
        }catch(Exception $e){
            Log::info("ERROR: " . $e->getMessage());
            return redirect()->back()->with('error', 'Tạo bài kiểm tra thất bại');
        }
    }

    // Show danh sách học sinh làm bài kiểm tra
    public function show($id, $examId, Request $request) {
        $classRoomId = $id;
        $exam = Exam::findOrFail($examId);

        $statusExam = $request->get('status-exam');
    
        $query = User::filter($request->all())->whereHas('classRooms', function ($query) use ($classRoomId) {
            $query->where('class_rooms.id', $classRoomId);
        })->where('role', '3');

        if ($statusExam == 'markscore') {
            $query->whereHas('answerExams', function ($query) use ($examId) {
                $query->where('exam_id', $examId)->where('score', '!=', NULL);
            });
        } elseif ($statusExam == 'notScore') {
            $query->whereDoesntHave('answerExams', function ($query) use ($examId) {
                $query->where('exam_id', $examId);
            });
        }
        
        $students = $query->paginate(10);
    
        return view('users.exams.show', compact('students', 'exam'));
    }

    public function edit($id, $examId){
        $classRoomId = $id;
        $exam = Exam::findOrFail($examId);
        $listTopic = Topic::has('questions')
                        ->with('questions')
                        ->get();
        return view('users.exams.edit', compact('exam', 'listTopic'));
    }
    
    public function update($id, $examId, Request $request){
        try{
            $classRoomId = $id;
            $exam = Exam::find($examId);
            $exam->update([
                'title' => $request->title,
                'time' => $request->time,
                'expiration_date' => $request->expiration_date
            ]);
    
            if ($request->has('questions')) {
                $exam->questions()->sync($request->questions);
            }
    
            return redirect()->route('class.exams', $classRoomId)->with('success', 'Cập nhật bài kiểm tra thành công');
        }catch(Exception $e){
            Log::info("ERROR: " . $e->getMessage());
            return redirect()->back()->with('error', 'Cập nhật bài kiểm tra thát bại');
        }
    }
    
    // xóa bài kiểm tra
    public function delete($id, $examId){
        try{
            $classRoomId = $id;
            $exam = Exam::find($examId);
            $exam->delete();
    
            return redirect()->route('class.exams', $classRoomId)->with('success', 'Xóa bài kiểm tra thành công');
        }catch(Exception $e){
            Log::info("ERROR: " . $e->getMessage());
            return redirect()->back()->with('error', 'Xóa bài kiểm tra thất bại');
        }
    }

    // xuất excel ds điểm học sinh theo bài kiểm tra
    public function printExcel(Request $request){
        return Excel::download(new ExamExport($request),"exam_" .  Carbon::now()->format('d:m:Y-H:i') . ".xlsx");
    }

    // Chi tiết bài nộp của từng học sinh
    public function detail($id, $examId, $studentId)
    {
        $classRoomId = $id;
        $exam = Exam::findOrFail($examId);
        $student = User::findOrFail($studentId);
        $questions = $exam->questions()->with('answers')->get();

        // Lấy ra đáp án đúng của câu hỏi
        $correctAnswerQuestions = $exam->questions()->with(['answers' => function($query) {
            $query->where('is_correct', true);
        }])->get();

        // Lấy điểm của học sinh cho bài kiểm tra này
        $score = $student->answerExams()
                        ->where('exam_id', $examId)
                        ->first()
                        ->pivot
                        ->score ?? 0;

        // Lấy tổng số câu hỏi của bài kiểm tra
        $totalQuestions = $exam->questions->count();

        // Chuyển đổi điểm thành thang điểm 10
        $maxScore = 10; 
        $scaledScore = ($maxScore / $totalQuestions);

        // Lấy ra các câu hỏi của bài kiểm tra
        $examQuestions = Exam::findOrFail($examId)->questions;

        // Lấy ra đáp án đúng của từng câu hỏi
        $correctAnswers = [];
        foreach ($examQuestions as $question) {
            $correctAnswer = AnswerQuestion::where('question_id', $question->id)
                                            ->where('is_correct', true)
                                            ->pluck('answer_index')
                                            ->first();
            $correctAnswers[$question->id] = $correctAnswer;
        }

        // Lấy ra đáp án của học sinh cho từng câu hỏi trong bài kiểm tra
        $studentAnswers = [];
        foreach ($examQuestions as $question) {
            $studentAnswer = $student->answerExams()
                                    ->where('exam_id', $examId)
                                    ->where('question_id', $question->id)
                                    ->pluck('answer')
                                    ->first();
            $studentAnswers[$question->id] = $studentAnswer;
        }

        // Tính số câu trả lời đúng, sai và chưa làm
        $correctCount = 0;
        $wrongCount = 0;
        $notAnsweredCount = 0;

        foreach ($examQuestions as $question) {
            if (array_key_exists($question->id, $studentAnswers)) {
                $studentAnswer = $studentAnswers[$question->id];
                $correctAnswer = $correctAnswers[$question->id];
                if ($studentAnswer !== null) {
                    if ($studentAnswer == $correctAnswer) {
                        $correctCount++;
                    } else {
                        $wrongCount++;
                    }
                } else {
                    $notAnsweredCount++;
                }
            } else {
                $notAnsweredCount++;
            }
        }

        $data = [
            'exam' => $exam,
            'student' => $student,
            'score' => $score,
            'scaledScore' => $scaledScore,
            'questions' => $questions,
            'correctAnswerQuestions' => $correctAnswerQuestions,
            'totalQuestions' => $totalQuestions,
            'correctCount' => $correctCount,
            'wrongCount' => $wrongCount,
            'notAnsweredCount' => $notAnsweredCount,
            'studentAnswers' => $studentAnswers,
            'correctAnswers' => $correctAnswers,
            'scaledScore' => $scaledScore,
        ];

        return view('users.exams.detail', $data);
    }


    // tính số câu đúng, sai, chưa làm của học sinh
    public function getAnswerStats($student, $examId, $questions)
    {
        // lấy ra các câu hỏi trong bài kiểm tra
        $exam = Exam::findOrFail($examId);
        $questions = $exam->questions()->get();
        dd($questions);
    }
    
    // Chi tiết bài kiểm tra
    public function detailExam($id, $examId){
        $exam = Exam::findOrFail($examId);
        $questions = $exam->questions()->with('answers')->get();
        $correctAnswerQuestions = $exam->questions()->with(['answers' => function($query) {
                            $query->where('is_correct', true);
                        }])->get();      
                    
        return view('users.exams.detail-exam', compact('exam', 'questions', 'correctAnswerQuestions'));
    }

    // học sinh làm bài kiểm tra
    public function submitExam(Request $request, $id, $examId, $studentId)
    {
        try{
            $classRoomId = $id;
            $user = User::findOrFail($studentId);
            $selectedAnswers = $request->input('answers');

            // Lấy tổng số câu hỏi của bài kiểm tra
            $exam = Exam::findOrFail($examId);
            $totalQuestions = $exam->questions->count();

            // lưu đáp án của học sinh
            foreach ($selectedAnswers as $questionId => $selectedAnswerIndex) {
                $user->answerExams()->attach($examId, [
                    'answer' => $selectedAnswerIndex,
                    'question_id' => $questionId
                ]);
            }

            // tính điểm
            $score = 0;
            foreach ($selectedAnswers as $questionId => $selectedAnswerId) {
                $correctAnswer = AnswerQuestion::where('question_id', $questionId)->where('is_correct', true)->first();
                
                if ($correctAnswer && $correctAnswer->answer_index == $selectedAnswerId) {
                    $score++;
                }
            }

            // Chuyển đổi điểm thành thang điểm 10
            $maxScore = 10; 
            $scaledScore = ($score / $totalQuestions) * $maxScore;

            // lưu điểm vào db
            $user->answerExams()->updateExistingPivot($examId, ['score' => $scaledScore]);
    
            return redirect()->route('class.exams', $classRoomId)->with('success', 'Nộp bài thành công');
        }catch(Exception $e){
            Log::info("ERROR: " . $e->getMessage());
            return redirect()->back()->with('error', 'Nộp bài thất bại');
        }
    }
}
