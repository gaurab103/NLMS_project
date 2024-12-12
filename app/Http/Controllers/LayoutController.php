<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LayoutController;
return
Route::get('student/portal', [LayoutController::class, 'layout']);
Route::get('student/portal/profile', [LayoutController::class, 'profile']);


