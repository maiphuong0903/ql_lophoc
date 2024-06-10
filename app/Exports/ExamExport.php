<?php

namespace App\Exports;

use App\Models\Exam;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class ExamExport implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $request;
    
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    
    public function collection()
    {
        $examId = $this->request->examId;
        $exam = Exam::find($examId);

        if (!$exam) {
            return collect(); 
        }

        $usersWithScores = $exam->userAnswerExams->map(function ($userAnswer) {
            return [
                'name' => $userAnswer->name, 
                'score' => $userAnswer->pivot->score, 
            ];
        });

        return $usersWithScores;
    }

    public function title(): string
    {
        $examId = $this->request->examId;
        $examName = Exam::find($examId)->title;
        
        return "Danh sách điểm bài kiểm tra $examName";
    }

    public function headings(): array
    {
        $examId = $this->request->examId;
        $examName = Exam::find($examId)->title;
        
        return [
            ['Danh sách điểm bài kiểm tra ' . $examName],
            [],
            [ 'Họ và tên', 'Điểm'],
        ];
    }

    public function map($exam): array
    {
        $user = $exam->userAnswerExams->first();
        $score = $exam->userAnswerExams->first()->pivot->score;

        return [
            $user->name,
            $score,
        ];
    }

}
