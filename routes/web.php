<?php
use App\Http\Controllers\StudentController;
use App\Http\Controllers\frontendControler;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
Route::get('/manageclass', function () {
    return view('manageclassstudent');
})->name('manageclass');


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
