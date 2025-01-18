<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\frontendControler;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('homepage');
});

// Admin Routes
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

Route::get('/manageclass', function () {
    return view('manageclassstudent');
})->name('manageclass');
// Route::get('/news', function () {
//     return view('news');
// })->name('news');


Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::post('/news', [NewsController::class, 'store'])->name('news.store');
Route::get('/news/edit/{id}', [NewsController::class, 'edit'])->name('news.edit');
Route::delete('/news/destroy/{id}', [NewsController::class, 'destroy'])->name('news.destroy');




// Uncomment the routes below if you're using authentication middleware
// Route::middleware('auth')->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->middleware(['verified'])->name('dashboard');

//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// Route::get("/",[frontendControler::class,'index'])->name('home');

// require __DIR__.'/auth.php';
