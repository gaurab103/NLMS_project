<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function showAttendancePage()
{
    // Get the authenticated student ID
    $studentId = auth()->guard('student')->id();

    // If no student is logged in, redirect to the login page
    if (!$studentId) {
        return redirect()->route('login')->withErrors('You need to be logged in to view your attendance.');
    }

    // Fetch attendance records for the logged-in student
    $attendance = Attendance::with(['student', 'course'])->where('student_id', $studentId)->get();

    // If no records are found, pass an empty collection to the view
    return view('attendance', [
        'attendance' => $attendance, 
        'error' => $attendance->isEmpty() ? 'No attendance records found for this student.' : null
    ]);
}
}
