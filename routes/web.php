<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\frontendControler;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\AttendanceController;

Route::get('/', function () {
    return view('homepage');
});

Route::get('/admin', function () {
    return view('admindashboard');
})->name('admin');

Route::get('/students', function () {
    return view('studentmanagement');
})->name('students');

Route::get('/teachers', function () {
    return view('teachersmanagement');
})->name('teachers');

Route::get('/attendance', function () {
    return view('attendance');
})->name('attendance');

Route::get('/news', function () {
    return view('news');
})->name('news');

Route::get('/student/portal/attendance', [AttendanceController::class, 'showAttendancePage'])->name('attendance.page');
Route::get('/student/portal', [StudentsController::class, 'index'])->name('portal');
Route::get('/student/portal/profile', [StudentsController::class, 'profile'])->name('profile');
Route::get('/student/profile/{id}', [ProfileController::class, 'showProfile'])->name('student.profile');
Route::get('/student/portal/{studentId}', [StudentController::class, 'showPortal']);
Route::get('/student/portal/profileedit/{id}', [StudentsController::class, 'editpro'])->name('edit.profile');
Route::put('/student/update-profile/{id}', [StudentsController::class, 'updatepro'])->name('update.profile');
