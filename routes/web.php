<?php

use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\ProfileController;
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

Route::get('class', [ClassRoomController::class, 'index'])->name('class');
Route::get('class/create', [ClassRoomController::class, 'create'])->name('class.create');
Route::post('class/store', [ClassRoomController::class, 'store'])->name('class.store');


Route::get('updateClass', function () {
    return view('users.classes.update');
});

Route::get('newsfeed', function () {
    return view('users.news.index');
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

