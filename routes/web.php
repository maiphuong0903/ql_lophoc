<?php

use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\NewsFeedController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopicController;
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

require __DIR__.'/auth.php';

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
    Route::post('member/addStudent', [MemberController::class, 'addStudent'])->name('class.member.addStudent');

    // document
    Route::get('{id}/document', [DocumentController::class, 'index'])->name('class.document');
    Route::get('{id}/document/show', [DocumentController::class, 'show'])->name('class.document.show');
    Route::post('{id}/document/store', [DocumentController::class, 'store'])->name('class.document.store');
    Route::delete('{id}/document/destroy', [DocumentController::class, 'destroy'])->name('class.document.destroy');

    // topic
    Route::post('{id}/topic/store', [TopicController::class, 'store'])->name('class.topic.store');
    Route::put('{id}/topic/update', [TopicController::class, 'update'])->name('class.topic.update');
    Route::delete('{id}/topic/destroy', [TopicController::class, 'destroy'])->name('class.topic.destroy');

});


Route::get('member', function () {
    return view('users.members.index');
});

Route::get('class-roles', function () {
    return view('users.class-roles.index');
});

Route::get('file', function () {
    return view('users.files.index');
});

Route::get('homework', function () {
    return view('users.homework.index');
});

Route::get('homework/create', function () {
    return view('users.homework.create');
});

Route::get('homework/show', function () {
    return view('users.homework.show');
});

Route::get('homework/detail', function () {
    return view('users.homework.detail');
});

Route::get('score', function () {
    return view('users.scores.index');
});

Route::get('questions', function () {
    return view('users.questions.index');
});

Route::get('exam-warehouse', function () {
    return view('users.exam-warehouse.index');
});

Route::get('exam/show', function () {
    return view('users.exams.show');
});

Route::get('exam', function () {
    return view('users.exams.index');
});

Route::get('exam/detail', function () {
    return view('users.exams.detail');
});

Route::get('exam/create', function () {
    return view('users.exams.create');
});

