<?php

namespace App\Http\Controllers;

use App\Exports\ScoreTableExport;
use App\Models\ClassRoom;
use App\Models\Exam;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ScoreTableController extends Controller
{
    public function index(Request $request){
        $classRoom = ClassRoom::find($request->id);
        $homeworks = $classRoom->homeworks;
        $exams = Exam::where('class_room_id', $classRoom->id)->get();
        $totalItems = count($homeworks) + count($exams);
        $students = User::filter($request->all())
                    ->whereHas('answerHomeworks', function ($query) use ($classRoom) {
                        $query->where('class_room_id', $classRoom->id)
                              ->whereNotNull('score');
                    })
                    ->orWhereHas('answerExams', function ($query) use ($classRoom) {
                        $query->where('class_room_id', $classRoom->id);
                    })
                    ->with(['answerHomeworks' => function ($query) use ($classRoom) {
                        $query->where('class_room_id', $classRoom->id);
                    }])
                    ->with(['answerExams' => function ($query) use ($classRoom) {
                        $query->where('class_room_id', $classRoom->id);
                    }])
                    ->paginate(10);

        return view('users.scores.index', compact('students', 'homeworks', 'exams', 'totalItems'));
    }

    public function exportScoreStudent(Request $request){
        return Excel::download(new ScoreTableExport($request),"ScoreTable_" .  Carbon::now()->format('d:m:Y-H:i') . ".xlsx");
    }

}
