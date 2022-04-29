<?php

use App\Http\Controllers\BatchesController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SemesterContoller;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect(route('login'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('departments', DepartmentController::class)->middleware('auth');
Route::resource('semesters', SemesterContoller::class)->middleware('auth');
Route::resource('batches', BatchesController::class)->middleware('auth');


