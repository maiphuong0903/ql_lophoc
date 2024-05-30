<?php

namespace App\Http\Controllers;

use App\Exports\ScoreTableExport;
use App\Models\ClassRoom;
use App\Models\HomeWork;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ScoreTableController extends Controller
{
    public function index(Request $request){
        $classRoom = ClassRoom::find($request->id);
        $homeworks = $classRoom->homeworks;
        $students = User::filter($request->all())->whereHas('answerHomeworks', function ($query) use ($classRoom) {
                        $query->where('class_room_id', $classRoom->id)
                            ->whereNotNull('users_answers_home_works.score');
                    })->paginate(10);

        return view('users.scores.index', compact('students', 'homeworks'));
    }

    public function exportScoreStudent(Request $request){
        return Excel::download(new ScoreTableExport($request),"ScoreTable_" .  Carbon::now()->format('d:m:Y-H:i') . ".xlsx");
    }

}
