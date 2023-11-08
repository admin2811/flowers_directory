<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlowerController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\BookController;
use App\Models\Flower;


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

Route::get('/',[FlowerController::class,'index']);
Route::resource('flowers',FlowerController::class);
Route::resource('students',StudentController::class);
Route::resource('books',BookController::class);
