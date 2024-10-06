<?php

use App\Http\Controllers\ClassAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('classes', [ClassAPIController::class, 'index']);
Route::post('classes/create', [ClassAPIController::class, 'store']);
Route::get('classes/edit/{id}', [ClassAPIController::class, 'edit']);
Route::put('classes/update/{id}', [ClassAPIController::class, 'update']);
Route::delete('classes/delete/{id}', [ClassAPIController::class, 'delete']);