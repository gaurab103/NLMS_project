<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function showAttendancePage()
    {
        try {
            $attendance = DB::table('attendances')->get();

            return view('attendance', ['attendanceRecords' => $attendance]);
        } catch (\Exception $e) {
            return view('attendance', ['error' => $e->getMessage()]);
        }
    }
}
