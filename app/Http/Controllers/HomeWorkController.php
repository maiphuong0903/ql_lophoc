<?php

namespace App\Http\Controllers;

use App\Exports\HomeWorksExport;
use App\Models\AnswerHomeWork;
use App\Models\ClassRoom;
use App\Models\HomeWork;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class HomeWorkController extends Controller
{
    public function index(Request $request)
    {
        $classRoomId = $request->id;

        $homeworks = Homework::filter($request->all())
                    ->where('class_room_id', $classRoomId)
                    ->whereHas('author', function ($query) use ($classRoomId) {
                        $query->whereHas('classRooms', function ($innerQuery) use ($classRoomId) {
                                $innerQuery->where('class_rooms.id', $classRoomId)
                                            ->where('role', 2); 
                                });
                            })
                    ->get();

        $classRooms = ClassRoom::where('created_by', auth()->user()->id)->get();

        return view('users.homework.index', compact('homeworks', 'classRooms'));
    }

    public function create(){
        return view('users.homework.create');
    }

    public function store(Request $request){
        try{
            $homework = $request->all();   
            
            if ($request->homework_file) {
                $homework['homework_file'] = $request->file('homework_file')->store('pdfs', 'public');
            }

            $homework['created_by'] = auth()->user()->id; 
            $homework['class_room_id'] = $request->class_room_id;
            HomeWork::create($homework);
            
            return redirect()->route('class.homework', $request->class_room_id )->with('success', 'Tạo bài tập lên thành công');
        }catch(Exception $e){
            Log::info("ERROR: " . $e->getMessage());
            return redirect()->back()->with('error', 'Tạo bài tập lên thất bại');
        }
    }   

    public function show($id, $homeworkId)
    {
        $homework = HomeWork::find($homeworkId);
        $filePath = config('app.url') . '/storage/' . $homework->homework_file;

        return view('users.homework.show-file-homework', compact('filePath'));
    }

    public function edit($classId, $homeworkId){
        $homework = HomeWork::find($homeworkId);
        
        return view('users.homework.edit', compact('homework'));
    }

    public function update(Request $request, $classId, $homeworkId){
        try{
            $homework = HomeWork::find($homeworkId);
            if (!$homework) {
                return redirect()->back()->with('error', 'Không tìm thấy bài tập');
            }
            $homeworkData = $request->all();
            $homeworkData['created_by'] = auth()->user()->id;

            if ($request->hasFile('homework_file') && $request->file('homework_file')->isValid()) {
                if ($homework->homework_file) {
                    Storage::disk('public')->delete($homework->homework_file);
                }
                
                $homeworkData['homework_file'] = $request->file('homework_file')->store('pdfs', 'public');
            }
            
            $homework->update($homeworkData);

            return redirect()->route('class.homework', $request->class_room_id )->with('success', 'Cập nhật bài tập lên thành công');
        }catch(Exception $e){
            Log::info("Error: " . $e->getMessage());
            return redirect()->route('class.homework', $request->class_room_id )->with('error', 'Cập nhật bài tập lên thất bại');
        }
    }

    public function destroy($id){
        try{
            $homework = HomeWork::find($id);
            if (!$homework) {
                return redirect()->back()->with('error', 'Không tìm thấy bài tập');
            }
            $homework->delete();
            return redirect()->back()->with('success', 'Xóa bài tập thành công');
        }catch(Exception $e){
            Log::info("Error: " . $e->getMessage());
            return redirect()->back()->with('error', 'Xóa bài tập thất bại');
        }
    }

    public function info(Request $request, $classId, $homeworkId){
        $homework = HomeWork::with(['assignedUsers' => function($query) {
            $query->whereNotNull('users_answers_home_works.answer'); 
        }])->find($homeworkId);
        
        $assignedUsers = $homework->assignedUsers()->filter($request->all())->paginate(10);
    
        return view('users.homework.homework-info', compact('assignedUsers', 'homework'));
    }

    public function detailHomeWork($id, $homeworkId){
        $homework = HomeWork::with('assignedUsers')->find($homeworkId);
        $isSubmitted = $homework->isSubmittedByStudent(auth()->user()->id);
        $hasDeadlinePassed = $homework->hasDeadlinePassed($homework->end_date);
        $filePath = config('app.url') . '/storage/' . $homework->homework_file;

        return view('users.homework.detail-homework', compact('homework', 'isSubmitted','hasDeadlinePassed', 'filePath'));
    }

    public function detailAnswerHomeWork($id, $homeworkId, $studentId){
        $homework = HomeWork::with(['assignedUsers' => function($query) use ($studentId) {
            $query->where('user_id', $studentId);
        }])->find($homeworkId);
      
        $student = User::find($studentId);

        return view('users.homework.mark-homework', compact('homework', 'student'));
    }

    public function markHomework(Request $request, $id, $homeworkId, $studentId){
        try{
            $homework = HomeWork::find($homeworkId);
    
            $homework->assignedUsers()->updateExistingPivot($studentId, [
                'score' => $request->input('score'),
                'comment' => $request->input('comment'),
            ]);
    
            return redirect()->route('class.homework.info', ['id' => $id, 'homeworkId' => $homeworkId])->with('success', 'Đã chấm bài');
        }catch(Exception $e){
            Log::info("Error: " . $e->getMessage());
            return redirect()->back()->with('error', 'Chấm bài thất bại');
        }
    }

    public function editScoreHomework(Request $request, $id, $homeworkId, $studentId){
        try{
            $homework = HomeWork::find($homeworkId);
    
            $homework->assignedUsers()->updateExistingPivot($studentId, [
                'score' => $request->input('score'),
            ]);
    
            return redirect()->back()->with('success', 'Cập nhật điểm thành công');
        }catch(Exception $e){
            Log::info("Error: " . $e->getMessage());
            return redirect()->back()->with('error', 'Cập nhật điểm thất bại');
        }
    }

    public function editCommentHomework(Request $request, $id, $homeworkId, $studentId){
        try{
            $homework = HomeWork::find($homeworkId);
    
            $homework->assignedUsers()->updateExistingPivot($studentId, [
                'comment' => $request->input('comment'),
            ]);
    
            return redirect()->back()->with('success', 'Cập nhật lời phê thành công');
        }catch(Exception $e){
            Log::info("Error: " . $e->getMessage());
            return redirect()->back()->with('error', 'Cập nhật lời phê thất bại');
        }
    }

    public function exportScoreHomeWork(Request $request){
        return Excel::download(new HomeWorksExport($request),"scoreHomeWork_" .  Carbon::now()->format('d:m:Y-H:i') . ".xlsx");
    }

    public function shareHomeWork(Request $request){
        try{
            DB::beginTransaction(); 
            
            $homeworkIds = json_decode($request->input('homework_ids'));
            foreach ($homeworkIds as $homeworkId) {
                $homework = HomeWork::find($homeworkId);
    
                foreach ($request->input('class') as $classId) {
                    $existingHomeWork = HomeWork::where('class_room_id', $classId)
                                                ->where('title', $homework->title)
                                                ->first();
    
                    if ($existingHomeWork) {
                        $classRoom = ClassRoom::find($classId);
                        $errorMessage = "Bài tập '{$homework->title}' đã tồn tại trong lớp '{$classRoom->name}'.";
                        return redirect()->back()->with('error', $errorMessage);
                    } else {
                        // Tạo bản sao của bài tập và gán mã lớp học mới
                        $newHomeWork = $homework->replicate();
                        $newHomeWork->class_room_id = $classId;
                        $newHomeWork->save();
                    }
                }
            }

            DB::commit();

            return redirect()->back()->with('success', 'Chia sẻ bài tập thành công');
        } catch(Exception $e) {
            DB::rollBack();
            Log::info("Error: " . $e->getMessage());
            return redirect()->back()->with('error', 'Chia sẻ bài tập thất bại');
        }
    }
}
