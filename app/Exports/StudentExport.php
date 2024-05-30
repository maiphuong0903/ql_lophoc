<?php

namespace App\Exports;

use App\Models\ClassRoom;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentExport implements FromCollection, WithHeadings, WithMapping
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
        $classRoomId = $this->request->id;
        $classRoomCreatorId = ClassRoom::find($classRoomId)->created_by;

        return User::filter($this->request->all())
                ->whereHas('classRooms', function ($query) use ($classRoomId) {
                    $query->where('class_rooms.id', $classRoomId)
                            ->where('user_class_rooms.content_role', 'Học sinh lớp');
                })
                ->whereNull('deleted_at')
                ->where('id', '!=', $classRoomCreatorId) 
                ->get();
    }

    public function headings(): array
    {
        return [
            'Họ và tên',
            'Email',
        ];
    }

    public function map($student): array
    {
        return [
            $student->name,
            $student->email,
        ];
    }
}
