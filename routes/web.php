<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\TeacherAuthController;
use App\Http\Controllers\Auth\StudentAuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\StudentNewsController;
use App\Http\Controllers\AdminAttendanceController;  // Added missing controller
use App\Http\Controllers\TeacherAttendanceController; // Added missing controller

Route::get('/login', function () {
    return redirect()->route('admin.login'); // Default login redirect
})->name('login');

Route::get('/', function () { return view('homepage'); })->name('home');

Route::get('/pannel', function () {
    return view('pannel');
})->name('pannel');

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admindashboard');
        })->name('admin.dashboard');
        Route::resource('students', StudentController::class);
        
        // News Routes
        Route::get('/news', [NewsController::class, 'index'])->name('news.index');
        Route::post('/news', [NewsController::class, 'store'])->name('news.store');
        Route::put('/news/{id}', [NewsController::class, 'update'])->name('news.update');
        Route::delete('/news/{id}', [NewsController::class, 'destroy'])->name('news.destroy');

        // Teacher Routes
        Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
        Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');
        Route::get('/teachers/{id}/edit', [TeacherController::class, 'edit'])->name('teachers.edit');
        Route::put('/teachers/{id}', [TeacherController::class, 'update'])->name('teachers.update');
        Route::delete('/teachers/{id}', [TeacherController::class, 'destroy'])->name('teachers.destroy');

        Route::get('/attendance', [AdminAttendanceController::class, 'index'])->name('admin.attendance');
        Route::get('/class', function () {
            return view('class');
        })->name('class');
    });
});

// Teacher Routes
Route::prefix('teacher')->group(function () {
    Route::get('/login', [TeacherAuthController::class, 'showLoginForm'])->name('teacher.login');
    Route::post('/login', [TeacherAuthController::class, 'login']);
    Route::post('/logout', [TeacherAuthController::class, 'logout'])->name('teacher.logout');

    Route::middleware('auth:teacher')->group(function () {
        Route::get('/dashboard', function () {
            return view('teacherportal');
        })->name('teacher.dashboard');
        Route::get('/assignmentportalteacher', function () {
            return view('assignmentportalteacher');
        })->name('teacher.assignment');
        Route::get('/notesteacher', function () {
            return view('notesteacher');
        })->name('teacher.notes');

        // Teacher Attendance Routes
        Route::get('/attendance', [TeacherAttendanceController::class, 'create'])
            ->name('teacher.attendance');
        Route::get('/attendance/students/{course}', [TeacherAttendanceController::class, 'getStudents'])
            ->name('teacher.attendance.students');
        Route::post('/attendance', [TeacherAttendanceController::class, 'store']);
    });
});

// Student Routes
Route::prefix('student')->group(function () {
    Route::get('/login', [StudentAuthController::class, 'showLoginForm'])->name('student.login');
    Route::post('/login', [StudentAuthController::class, 'login']);
    Route::post('/logout', [StudentAuthController::class, 'logout'])->name('student.logout');

    Route::middleware('auth:student')->group(function () {
        Route::get('/dashboard', function () {
            return view('layout');
        })->name('student.dashboard');

        Route::get('/profile', [StudentsController::class, 'profile'])->name('student.profile');
        
        Route::get('/attendance', [AttendanceController::class, 'showAttendancePage'])->name('student.attendance');
        Route::get('/attendance/fetch', [StudentAuthController::class, 'fetchAttendance'])->name('student.attendance.fetch');

        Route::get('/notes', [NotesController::class, 'notes'])->name('student.notes');
        Route::get('/assignments', [AssignmentController::class, 'assignments'])->name('student.assignment');
        Route::get('/messages', [MessageController::class, 'messages'])->name('student.message');
        Route::get('/subjects', [SubjectController::class, 'subjects'])->name('student.subject');
        Route::get('/news', [StudentNewsController::class, 'news'])->name('student.news');
    });
});

Route::get('logout', function () {
    return view('homepage');
})->name('settings');
