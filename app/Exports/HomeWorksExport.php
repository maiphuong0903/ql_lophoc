<?php

namespace App\Exports;

use App\Models\HomeWork;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class HomeWorksExport implements FromCollection, WithHeadings, WithMapping
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

    public function headings(): array
    {
        return [
            'Họ và tên',
            'Bài tập',
            'Điểm',
            'Ngày nộp bài',
        ];
    }

    public function map($homework): array
    {
        $user = $homework->assignedUsers->first();
        $score = $homework->assignedUsers->first()->pivot->score ?? 'Chờ chấm';

        return [
            $user->name,
            $homework->title,
            $score,
            Carbon::parse($user->pivot->created_at)->format('d/m/Y H:i'),
        ];
    }
}
