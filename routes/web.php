<?php

use App\Http\Controllers\AttendanceSheetController;
use App\Http\Controllers\BatchesController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\SemesterContoller;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TimeTableController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxContoller;
use App\Http\Controllers\ExportController;

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
Route::resource('subjects', SubjectController::class)->middleware('auth');
Route::resource('teachers', TeacherController::class)->middleware('auth');
Route::resource('students', StudentController::class)->middleware('auth');
Route::resource('time-table', TimeTableController::class);
Route::get('/time-table/{batchID}/view', [TimeTableController::class, 'view'])->name('time-table.view');
Route::get('/time-table/{batchID}/create', [TimeTableController::class, 'create'])->name('time-table.batch.create');
Route::post('/time-table/{batchID}/store', [TimeTableController::class, 'store'])->name('time-table.batch.store');
Route::get('/time-table/{batchID}/edit/{id}', [TimeTableController::class, 'edit'])->name('time-table.batch.edit');
Route::delete('/time-table/{batchID}/destroy/{id}', [TimeTableController::class, 'destroy'])->name('time-table.batch.destroy');

Route::get('/attendance-sheet', [AttendanceSheetController::class, 'view'])->name('attendance-sheet.view');

Route::post('/attendance-sheet/generate', [AttendanceSheetController::class, 'generate'])->name('attendance-sheet.generate');


Route::get('/import', [ImportController::class, 'index'])->name('import.index');
// Route::get('/import', 'ImportController@getImport')->name('import');
Route::post('/import_parse/{name}', [ImportController::class, 'parseImport'])->name('import.parse');
Route::post('/import_process', [ImportController::class, 'processImport'])->name('import.process');

Route::get('/export', [ExportController::class, 'index'])->name('export.index');
Route::get('/export-process', [ExportController::class, 'export'])->name('export.process');




Route::post('/get-semester', [AjaxContoller::class, 'get_semester'])->name('ajax.get_semester');
Route::post('/get-teacher', [AjaxContoller::class, 'get_teacher'])->name('ajax.get_teacher');
Route::post('/get-subject', [AjaxContoller::class, 'get_subject'])->name('ajax.get_subject');

