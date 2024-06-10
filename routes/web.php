<?php

use App\Http\Controllers\AdminClassController;
use App\Http\Controllers\AdminNotiController;
use App\Http\Controllers\AdminStudentController;
use App\Http\Controllers\AdminTeacherController;
use App\Http\Controllers\ClassRoleController;
use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\HomeWorkController;
use App\Http\Controllers\NewsFeedController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\NotiController;
use App\Http\Controllers\ScoreTableController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('join-class', [ClassRoomController::class, 'joinClassRoom'])->name('class.joinClassRoom');
Route::post('join-class', [ClassRoomController::class, 'joinClassRoomStore'])->name('class.joinClassRoom.store');
Route::post('update-join-class', [ClassRoomController::class, 'joinClassRoomUpdate'])->name('class.joinClassRoom.update');

Route::prefix('class')->group(function () {
    // class
    Route::get('/', [ClassRoomController::class, 'index'])->name('class');
    Route::get('create', [ClassRoomController::class, 'create'])->name('class.create');
    Route::post('store', [ClassRoomController::class, 'store'])->name('class.store');
    Route::get('{id}/edit', [ClassRoomController::class, 'edit'])->name('class.edit');
    Route::put('{id}/update', [ClassRoomController::class, 'update'])->name('class.update');
    Route::delete('{id}/destroy', [ClassRoomController::class, 'destroy'])->name('class.destroy');

    // newsfeed
    Route::get('{id}/newsfeed', [NewsFeedController::class, 'index'])->name('class.newsfeed');
    Route::post('newsfeed/store', [NewsFeedController::class, 'store'])->name('class.newsfeed.store');
    Route::put('{id}/newsfeed/update', [NewsFeedController::class, 'update'])->name('class.newsfeed.update');
    Route::delete('{id}/newsfeed/destroy', [NewsFeedController::class, 'destroy'])->name('class.newsfeed.destroy');

    // newsfeed comment
    Route::post('{id}/newsfeed/comment/store', [CommentController::class, 'store'])->name('class.newsfeed.comment.store');
    Route::delete('{newsfeedId}/newsfeed/comment/{commentId}/destroy', [CommentController::class, 'destroy'])->name('class.newsfeed.comment.destroy');

    // student
    Route::get('{id}/student', [StudentController::class, 'index'])->name('class.student');
    Route::post('{id}/student/addStudent', [StudentController::class, 'addStudent'])->name('class.student.addStudent');
    Route::delete('{classId}/student/{studentId}/destroy', [StudentController::class, 'deleteStudent'])->name('class.student.deleteStudent');
    Route::get('{id}/student/printExcel', [StudentController::class, 'exportStudent'])->name('student.printExcel');
    Route::delete('{classId}/student/{studentId}/leaveClass', [StudentController::class, 'leaveClass'])->name('class.student.leaveClass');
    Route::post('{homeworkId}/student/{studentId}/createAnswerHomeWork', [StudentController::class, 'createAnswerHomeWork'])->name('class.student.createAnswerHomeWork');

    // file
    Route::get('{id}/document', [DocumentController::class, 'index'])->name('class.document');
    Route::get('{id}/document/{documentId}/detail', [DocumentController::class, 'show'])->name('class.document.show');
    Route::post('{id}/document/store', [DocumentController::class, 'store'])->name('class.document.store');
    Route::delete('{id}/document/destroy', [DocumentController::class, 'destroy'])->name('class.document.destroy');
    Route::post('{id}/document/share-file', [DocumentController::class, 'shareFile'])->name('class.document.shareFile');

    // topic
    Route::post('{id}/topic/store', [TopicController::class, 'store'])->name('class.topic.store');
    Route::put('{id}/topic/update', [TopicController::class, 'update'])->name('class.topic.update');
    Route::delete('{id}/topic/destroy', [TopicController::class, 'destroy'])->name('class.topic.destroy');

    // homework
    Route::get('{id}/homework', [HomeWorkController::class, 'index'])->name('class.homework');
    Route::get('{id}/homework/create', [HomeWorkController::class, 'create'])->name('class.homework.create');
    Route::post('{id}/homework/store', [HomeWorkController::class, 'store'])->name('class.homework.store');
    Route::get('{id}/homework/{homeworkId}/edit', [HomeWorkController::class, 'edit'])->name('class.homework.edit');
    Route::put('{id}/homework/{homeworkId}/update', [HomeWorkController::class, 'update'])->name('class.homework.update');
    Route::delete('{id}/homework/destroy', [HomeWorkController::class, 'destroy'])->name('class.homework.destroy');
    Route::get('{id}/homework/{homeworkId}/show', [HomeWorkController::class, 'show'])->name('class.homework.show-file-homework');
    Route::get('{id}/homework/{homeworkId}/info', [HomeWorkController::class, 'info'])->name('class.homework.info');
    Route::get('{id}/homework/{homeworkId}/detailHomeWork', [HomeWorkController::class, 'detailHomeWork'])->name('class.homework.detailHomeWork');
    Route::get('{id}/homework/{homeworkId}/student/{studentId}/detailAnswer', [HomeWorkController::class, 'detailAnswerHomeWork'])->name('class.homework.detailAnswerHomeWork');
    Route::post('{id}/homework/{homeworkId}/student/{studentId}/detailAnswer', [HomeWorkController::class, 'markHomework'])->name('class.homework.markHomework');
    Route::put('{id}/homework/{homeworkId}/student/{studentId}/detailAnswer/updateScore', [HomeWorkController::class, 'editScoreHomework'])->name('class.homework.editScoreHomework');
    Route::put('{id}/homework/{homeworkId}/student/{studentId}/detailAnswer/updateComment', [HomeWorkController::class, 'editCommentHomework'])->name('class.homework.editCommentHomework');
    Route::get('{id}/homework/{homeworkId}/printExcel', [HomeWorkController::class, 'exportScoreHomeWork'])->name('homework.printExcel');
    Route::post('{id}/homework/share-homework', [HomeWorkController::class, 'shareHomeWork'])->name('class.homework.shareHomeWork');

    //questions
    Route::get('{id}/questions', [QuestionController::class, 'index'])->name('class.questions');
    Route::post('{id}/questions/store', [QuestionController::class, 'store'])->name('class.questions.store');
    Route::get('{id}/questions/{questionId}/edit', [QuestionController::class, 'edit'])->name('class.questions.edit');
    Route::put('{id}/questions/{questionId}/update', [QuestionController::class, 'update'])->name('class.questions.update');
    Route::delete('{id}/questions/destroy', [QuestionController::class, 'destroy'])->name('class.questions.destroy');

    // exam
    Route::get('{id}/exams', [ExamController::class, 'index'])->name('class.exams');
    Route::get('{id}/exams/create', [ExamController::class, 'create'])->name('class.exams.create');
    Route::post('{id}/exams/store', [ExamController::class, 'store'])->name('class.exams.store');
    Route::get('{id}/exams/{examId}/edit', [ExamController::class, 'edit'])->name('class.exams.edit');
    Route::put('{id}/exams/{examId}/update', [ExamController::class, 'update'])->name('class.exams.update');
    Route::get('{id}/exams/{examId}/show', [ExamController::class, 'show'])->name('class.exams.show');
    Route::delete('{id}/exams/{examId}/delete', [ExamController::class, 'delete'])->name('class.exams.delete');
    Route::get('{id}/exams/{examId}/printExcel', [ExamController::class, 'printExcel'])->name('class.exams.printExcel');
    Route::get('{id}/exams/{examId}/student/{studentId}/detail', [ExamController::class, 'detail'])->name('class.exams.detail');
    Route::get('{id}/exams/{examId}/detailExam', [ExamController::class, 'detailExam'])->name('class.exams.detailExam');
    Route::post('{id}/exams/{examId}/student/{studentId}/submit', [ExamController::class, 'submitExam'])->name('class.exams.submitExam');

    // class role - teacher
    Route::get('{id}/teacher', [ClassRoleController::class, 'index'])->name('class.class-role');
    Route::post('{id}/teacher/addTeacher', [ClassRoleController::class, 'addTeacher'])->name('class.class-role.addTeacher');
    Route::delete('{id}/teacher/{teacherId}/destroy', [ClassRoleController::class, 'deleteTeacher'])->name('class.class-role.deleteTeacher');
    Route::get('{id}/teacher/printExcel', [ClassRoleController::class, 'exportTeacher'])->name('class-role.printExcel');
    Route::delete('{id}/user/{userId}/rejectJoinClass/{notiId}', [ClassRoleController::class, 'rejectJoinClass'])->name('class.user.rejectJoinClass');
    Route::post('{id}/user/{userId}/acceptJoinClass/{notiId}', [ClassRoleController::class, 'acceptJoinClass'])->name('class.user.acceptJoinClass');

    // score table
    Route::get('{id}/score-table', [ScoreTableController::class, 'index'])->name('class.score-table');
    Route::get('{id}/score-table/printExcel', [ScoreTableController::class, 'exportScoreStudent'])->name('score-table.printExcel');

    // noti
    Route::post('{id}/noti/store', [NotiController::class, 'store'])->name('class.noti.store');
    Route::delete('{classId}/noti/{notiId}/destroy', [NotiController::class, 'destroy'])->name('class.noti.destroy');

});

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::prefix('admin')->group(function () {
    // teacher
    Route::get('teacher', [AdminTeacherController::class, 'index'])->name('admin.teacher');
    Route::get('teacher/create', [AdminTeacherController::class, 'create'])->name('admin.teacher.create');
    Route::post('teacher/store', [AdminTeacherController::class, 'store'])->name('admin.teacher.store');
    Route::get('teacher/{id}/edit', [AdminTeacherController::class, 'edit'])->name('admin.teacher.edit');
    Route::put('teacher/{id}/update', [AdminTeacherController::class, 'update'])->name('admin.teacher.update');
    Route::delete('teacher/{id}/delete', [AdminTeacherController::class, 'delete'])->name('admin.teacher.delete');
    
    // class
    Route::get('class', [AdminClassController::class, 'index'])->name('admin.class');

    // student
    Route::get('student', [AdminStudentController::class, 'index'])->name('admin.student');
    Route::get('student/create', [AdminStudentController::class, 'create'])->name('admin.student.create');
    Route::post('student/store', [AdminStudentController::class, 'store'])->name('admin.student.store');
    Route::delete('student/{id}/delete', [AdminStudentController::class, 'delete'])->name('admin.student.delete');

    // noti
    Route::get('noti', [AdminNotiController::class, 'index'])->name('admin.noti');
    Route::post('noti/{notiId}/update-status', [AdminNotiController::class, 'updateSatusNoti'])->name('admin.noti.update-status-noti');
    Route::delete('noti/{id}/delete', [AdminNotiController::class, 'delete'])->name('admin.noti.delete');

});
