<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/addstudent', [StudentController::class, 'add'])->name('addstudent');
Route::post('/addstudentform', [StudentController::class, 'studentformdata'])->name('addstudentform');
Route::get('/editstudent/{id}', [StudentController::class, 'editstudent'])->name('editstudent');
Route::post('/updatestudentform', [StudentController::class, 'updatestudentform'])->name('updatestudentform');
Route::post('/deletestudent', [StudentController::class, 'deletestudent'])->name('deletestudent');

