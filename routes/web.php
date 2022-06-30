<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\eventController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[eventController::class, 'index']);
Route::get('/createEvent',[eventController::class, 'create']);
Route::post('/createEvent',[eventController::class, 'insert']);
Route::get('/editEvent/{id}',[eventController::class, 'edit']);
Route::post('/editEvent/{id}',[eventController::class, 'update']);
Route::get('/viewEvent',[eventController::class, 'view']);
Route::get('/viewEvent/delete/{id}',[eventController::class, 'delete'])->name('viewEvent.delete');