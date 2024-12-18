<?php

namespace App\Http\Controllers;

use App\Models\Attendance;

class AttendanceController extends Controller
{
    // Method to fetch attendance data
    // In AttendanceController.php
    // In AttendanceController.php
    public function showAttendancePage()
    {
        $attendance = Attendance::all(); // Fetch all attendance records

        // Ensure attendance data is being passed to the view correctly
        return view('attendance', ['attendance' => $attendance]);
    }
}
