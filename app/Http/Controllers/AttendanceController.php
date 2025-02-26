<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function showAttendancePage()
    {
        $studentId = auth()->guard('student')->id();
        $attendance = Attendance::where('Std_ID', $studentId)->get();

        if ($attendance->isEmpty()) {
            return view('attendance', ['error' => 'No attendance records found for this student.']);
        }

        return view('attendance', compact('attendance'));
    }
    
}