<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TeacherExport implements FromCollection, WithHeadings, WithMapping
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
        return User::filter($this->request->all())
                    ->whereHas('classRooms', function ($query) {
                        $query->where('class_rooms.id', $this->request->id)
                            ->where('user_class_rooms.content_role', '!=', 'Học sinh lớp');
                    })
                    ->whereNull('deleted_at')
                    ->where('role', 2)
                    ->get();
    }

    public function headings(): array
    {
        return [
            'Họ và tên',
            'Vai trò',
            'Email',
        ];
    }

    public function map($teacher): array
    {
        $roles = $teacher->classRooms->pluck('pivot.content_role')->implode(', ');
        return [
            $teacher->name,
            $roles,
            $teacher->email,
        ];
    }
}
