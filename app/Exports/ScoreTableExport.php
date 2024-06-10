<?php

namespace App\Exports;

use App\Models\ClassRoom;
use App\Models\HomeWork;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class ScoreTableExport implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $request;
    protected $homeworkTitles = [];
    
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    
    public function collection()
    {
        $classRoomId = $this->request->id;

        $users = User::filter($this->request->all())->whereHas('answerHomeworks', function ($query) use ($classRoomId) {
            $query->where('class_room_id', $classRoomId)
                  ->whereNotNull('users_answers_home_works.score');
        })->get();

       
        $homeworks = HomeWork::where('class_room_id', $classRoomId)->get();

        $userScores = [];

        foreach ($users as $user) {
            $userScores[$user->id] = [];
            foreach ($homeworks as $homework) {
                $score = $user->answerHomeworks()->where('home_work_id', $homework->id)->first()->pivot->score ?? 'Chờ chấm';
                $userScores[$user->id][$homework->title] = $score;
            }
        }

        foreach ($users as $user) {
            $user->homework_scores = $userScores[$user->id];
        }

        $this->homeworkTitles = $homeworks->pluck('title')->toArray();
 
        return $users;
    }

    public function title(): string
    {
        $classRoomId = $this->request->id;
        $className = ClassRoom::find($classRoomId)->name;
        
        return "Danh sách điểm của lớp $className";
    }

    public function headings(): array
    {
        $homework_titles = $this->homeworkTitles ?? [];
        $classRoomId = $this->request->id;
        $className = ClassRoom::find($classRoomId)->name;

        $headings = [
            ['Danh sách học sinh lớp ' . $className],
            [],
            ['Họ và tên'],
        ];

        foreach ($homework_titles as $title) {
            $headings[] = $title;
        }
    
        $headings[] = ['Điểm trung bình'];

        return $headings;
    }

    public function map($student): array
    {
        $homework_scores = array_values($student->homework_scores ?? []);
        
        $total_score = 0;
        $count = 0;
        foreach ($homework_scores as $score) {
            if ($score !== 'Chờ chấm') {
                $total_score += $score;
                $count++;
            }
        }
        $average_score = ($count > 0) ? round($total_score / $count, 2) : 0;

        return [
            $student->name,
            ...$homework_scores,
            $average_score,
        ];
    }
}
