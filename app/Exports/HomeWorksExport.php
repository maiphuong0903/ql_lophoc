<?php

namespace App\Exports;

use App\Models\HomeWork;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class HomeWorksExport implements FromCollection, WithHeadings, WithMapping, WithTitle
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
        $homeworks = HomeWork::all();

        $filteredHomeworks = collect();

        foreach ($homeworks as $homework) {
            if ($homework->assignedUsers()->whereNotNull('users_answers_home_works.answer')->exists()) {
                $filteredHomeworks->push($homework);
            }
        }

        return $filteredHomeworks;
    }

    public function title(): string
    {
        $homeWorkId = $this->request->homeworkId;
        $homeWorkName = HomeWork::find($homeWorkId)->title;
        
        return "Danh sách điểm bài tập $homeWorkName";
    }
    
    public function headings(): array
    {
        $homeWorkId = $this->request->homeworkId;
        $homeWorkName = HomeWork::find($homeWorkId)->title;
        
        return [
            ['Danh sách điểm bài tập ' . $homeWorkName],
            [],
            [ 'Họ và tên', 'Điểm'],
        ];
    }

    public function map($homework): array
    {
        $user = $homework->assignedUsers->first();
        $score = $homework->assignedUsers->first()->pivot->score ?? 'Chờ chấm';

        return [
            $user->name,
            $score,
        ];
    }
}
