<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\frontendControler;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\AttendanceController;

Route::get('/', function () {
    return view('homepage');
})->name('homepage');

Route::get('/admin', function () {
    return view('admindashboard');
})->name('admin');

Route::get('/students', function () {
    return view('studentmanagement');
})->name('students');
Route::get('/attendance', function () {
    return view('attendance');
})->name('attendance');

Route::get('/news', function () {
    return view('news');
})->name('news');

Route::get('/pannel', function () {
    return view('pannel');
})->name('pannel');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::post('/news', [NewsController::class, 'store'])->name('news.store');
Route::put('/news/{id}', [NewsController::class, 'update'])->name('news.update');
Route::delete('/news/{id}', [NewsController::class, 'destroy'])->name('news.destroy');

Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');
Route::get('/teachers/{id}/edit', [TeacherController::class, 'edit'])->name('teachers.edit');
Route::put('/teachers/{id}', [TeacherController::class, 'update'])->name('teachers.update');
Route::delete('/teachers/{id}', [TeacherController::class, 'destroy'])->name('teachers.destroy');

Route::get('/student/portal/attendance', [AttendanceController::class, 'showAttendancePage'])->name('attendance.page');
Route::get('/student/portal', [StudentsController::class, 'index'])->name('portal');
Route::get('/student/portal/profile', [StudentsController::class, 'profile'])->name('profile');
Route::get('/student/profile/{id}', [ProfileController::class, 'showProfile'])->name('student.profile');
Route::get('/student/portal/{studentId}', [StudentsController::class, 'showPortal']);
Route::get('/student/portal/profileedit/{id}', [StudentsController::class, 'editpro'])->name('edit.profile');
Route::put('/student/update-profile/{id}', [StudentsController::class, 'updatepro'])->name('update.profile');





// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
// Route::get("/",[frontendControler::class,'index'])->name('home');

// require __DIR__.'/auth.php';
