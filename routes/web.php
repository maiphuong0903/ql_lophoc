<?php

use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\HomeWorkController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\NewsFeedController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ExamController;
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
    Route::delete('{id}/newsfeed/comment/destroy', [CommentController::class, 'destroy'])->name('class.newsfeed.comment.destroy');

    // member
    Route::get('{id}/member', [MemberController::class, 'index'])->name('class.member');
    Route::post('{id}/member/addStudent', [MemberController::class, 'addStudent'])->name('class.member.addStudent');

    // document
    Route::get('{id}/document', [DocumentController::class, 'index'])->name('class.document');
    Route::get('{id}/document/{documentId}/detail', [DocumentController::class, 'show'])->name('class.document.show');
    Route::post('{id}/document/store', [DocumentController::class, 'store'])->name('class.document.store');
    Route::delete('{id}/document/destroy', [DocumentController::class, 'destroy'])->name('class.document.destroy');

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

    //questions
    Route::get('{id}/questions', [QuestionController::class, 'index'])->name('class.questions');
    Route::post('{id}/questions/store', [QuestionController::class, 'store'])->name('class.questions.store');
    Route::get('{id}/questions/{questionId}/edit', [QuestionController::class, 'edit'])->name('class.questions.edit');
    Route::put('{id}/questions/update', [QuestionController::class, 'update'])->name('class.questions.update');
    Route::delete('{id}/questions/destroy', [QuestionController::class, 'destroy'])->name('class.questions.destroy');

    // exam
    Route::get('{id}/exams', [ExamController::class, 'index'])->name('class.exams');
    Route::post('{id}/exams/store', [ExamController::class, 'store'])->name('class.exams.store');
});
