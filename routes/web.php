<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\TeacherAuthController;
use App\Http\Controllers\Auth\StudentAuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\AttendanceController;

Route::get('/login', function () {
    return redirect()->route('admin.login'); // Or any default login page
})->name('login');

Route::get('/', function () {
    return view('homepage');
})->name('home');

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

        // News Routes
        Route::get('/news', [NewsController::class, 'index'])->name('news.index');
        Route::post('/news', [NewsController::class, 'store'])->name('news.store');
        Route::put('/news/{id}', [NewsController::class, 'update'])->name('news.update');
        Route::delete('/news/{id}', [NewsController::class, 'destroy'])->name('news.destroy');

        // Teacher Routes (only under admin)
        Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
        Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');
        Route::get('/teachers/{id}/edit', [TeacherController::class, 'edit'])->name('teachers.edit');
        Route::put('/teachers/{id}', [TeacherController::class, 'update'])->name('teachers.update');
        Route::delete('/teachers/{id}', [TeacherController::class, 'destroy'])->name('teachers.destroy');

        // Student Routes
        Route::get('/students', function () {
            return view('studentmanagement');
        })->name('students');

        Route::get('/attendance', function () {
            return view('attendance');
        })->name('attendance');

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
        
            Route::get('/profile', function () {
                return view('profile'); 
            })->name('student.profile');
            
            Route::get('/profile/edit/{id}', function ($id) {
                return view('profile_edit', compact('id'));
            })->name('edit.profile');
            
            Route::put('/profile/update/{id}', [StudentAuthController::class, 'updatepro'])->name('update.profile');
            
            Route::get('/attendance', function () {
                return view('attendance'); 
            })->name('student.attendance');
            
            Route::get('/attendance/fetch', [StudentAuthController::class, 'fetchAttendance'])->name('student.attendance.fetch');
            
            Route::get('/notes', function () {
                return view('notes'); 
            })->name('student.notes');
            
            Route::get('/assignments', function () {
                return view('assignments');
            })->name('student.assignments');
            
            Route::get('/messages', function () {
                return view('messages'); 
            })->name('student.messages');
            
            Route::get('/subjects', function () {
                return view('subjects'); 
            })->name('student.subjects');
        });
    });


Route::get('logout', function () {
    return view('homepage');
})->name('settings');
