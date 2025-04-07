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
use App\Http\Controllers\TeacherAttendanceController;
use App\Http\Controllers\StudentAttendanceController;
use App\Http\Controllers\AdminAttendanceController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ClassController;

Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

Route::get('/', function () {
    return view('homepage');
})->name('home');

Route::get('/pannel', function () {
    return view('pannel');
})->name('pannel');

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admindashboard');
        })->name('admin.dashboard');
        Route::resource('students', StudentController::class);
        Route::get('/news', [NewsController::class, 'index'])->name('news.index');
        Route::post('/news', [NewsController::class, 'store'])->name('news.store');
        Route::put('/news/{id}', [NewsController::class, 'update'])->name('news.update');
        Route::delete('/news/{id}', [NewsController::class, 'destroy'])->name('news.destroy');
        Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
        Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');
        Route::get('/teachers/{id}/edit', [TeacherController::class, 'edit'])->name('teachers.edit');
        Route::put('/teachers/{id}', [TeacherController::class, 'update'])->name('teachers.update');
        Route::delete('/teachers/{id}', [TeacherController::class, 'destroy'])->name('teachers.destroy');
        Route::get('/attendance', [AdminAttendanceController::class, 'index'])->name('admin.attendance');
        Route::get('/attendance/chart-data', [AdminAttendanceController::class, 'getChartData'])->name('admin.attendance.chart');
        Route::resource('classes', ClassController::class);
        Route::resource('subjects', SubjectController::class)->except(['index', 'create', 'show']);
        Route::get('/classes/{class}/subjects/{subject}', [SubjectController::class, 'show'])->name('classes.subjects.show');
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
            return view('teacherportal', ['active' => 'home']);
        })->name('teacher.dashboard');

        Route::get('/notes', [NotesController::class, 'teacherNotes'])->name('teacher.notes');
        Route::post('/notes', [NotesController::class, 'store'])->name('teacher.notes.store');
        Route::resource('assignments', AssignmentController::class)->except(['create']);
        Route::get('/assignments/{assignment}/submissions', [AssignmentController::class, 'showSubmissions'])->name('assignments.submissions');
        Route::post('/assignments/submissions/{submission}/evaluate', [AssignmentController::class, 'evaluateSubmission'])->name('assignments.submissions.evaluate');
        Route::get('/subjects-by-class/{classId}', function ($classId) {
            $subjects = \App\Models\Subject::where('course_id', $classId)
                                           ->where('teacher_id', auth()->guard('teacher')->id())
                                           ->get(['id', 'name']);
            return response()->json($subjects);
        })->name('subjects.by.class');
        Route::get('/attendance', [TeacherAttendanceController::class, 'create'])->name('teacher.attendance.create');
        Route::get('/attendance/students/{course}', [TeacherAttendanceController::class, 'getStudents'])->name('teacher.attendance.students');
        Route::post('/attendance', [TeacherAttendanceController::class, 'store'])->name('teacher.attendance.store');
        Route::get('/news', [NewsController::class, 'TeacherIndex'])->name('teacher.news');
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

        Route::get('/profile', [StudentAuthController::class, 'profile'])->name('student.profile');

        Route::get('/profile/edit/{id}', function ($id) {
            return view('profile_edit', compact('id'));
        })->name('edit.profile');

        Route::put('/profile/update/{id}', [StudentAuthController::class, 'updatepro'])->name('update.profile');

        Route::get('/attendance', [AttendanceController::class, 'showAttendancePage'])->name('attendance');

        Route::get('/attendance/fetch', [StudentAuthController::class, 'fetchAttendance'])->name('student.attendance.fetch');

        Route::get('/notes', [NotesController::class, 'notes'])->name('student.notes');

        Route::get('/assignments', [AssignmentController::class, 'showForStudent'])->name('student.assignments');

        Route::get('/messages', function () {
            return view('messages');
        })->name('student.messages');

        Route::get('/subjects', [SubjectController::class, 'studentshow'])->name('student.subject');

        Route::get('news', [NewsController::class, 'studentIndex'])->name('student.news');
    });
});

Route::get('logout', function () {
    return view('homepage');
})->name('settings');
