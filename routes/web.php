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

// For home page.
Route::get('/',[eventController::class, 'index']);

// For create event page.
Route::get('/createEvent',[eventController::class, 'create']);

// For inserting an event.
Route::post('/createEvent',[eventController::class, 'insert']);

// For edit event page.
Route::get('/editEvent/{id}',[eventController::class, 'edit']);

// For updating event.
Route::post('/editEvent/{id}',[eventController::class, 'update']);

// For viwing events.
Route::get('/viewEvent',[eventController::class, 'view']);

// For deleting event.
Route::get('/viewEvent/delete/{id}',[eventController::class, 'delete'])->name('viewEvent.delete');