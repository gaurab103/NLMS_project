<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Course;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminAttendanceController extends Controller
{
    public function index(Request $request)
    {
        // Build the attendance query with filters
        $attendanceQuery = Attendance::with(['student', 'course'])
            ->when($request->course_id, fn($q) => $q->where('course_id', $request->course_id))
            ->when($request->student_id, fn($q) => $q->where('student_id', $request->student_id))
            ->when($request->date, fn($q) => $q->whereDate('date', $request->date))
            ->when($request->daterange, function ($q) use ($request) {
                // Corrected date range separator to 'to'
                $dates = explode(' to ', $request->daterange);
                $q->whereBetween('date', [
                    Carbon::parse($dates[0])->startOfDay(),
                    Carbon::parse($dates[1])->endOfDay()
                ]);
            });

        // Default to today's date if no filters are applied
        if (!$request->course_id && !$request->student_id && !$request->date && !$request->daterange) {
            $attendanceQuery->whereDate('date', today());
        }

        // Paginate the filtered records
        $attendance = $attendanceQuery->orderByDesc('date')->paginate(30);

        // Calculate statistics based on the filtered query
        $stats = [
            'total' => $attendanceQuery->count(),
            'present' => $attendanceQuery->clone()->where('status', 'present')->count(),
            'absent' => $attendanceQuery->clone()->where('status', 'absent')->count(),
            'average' => $attendanceQuery->count() > 0
                ? $attendanceQuery->clone()->where('status', 'present')->count() / $attendanceQuery->count()
                : 0,
            'unique_students' => $attendanceQuery->distinct('student_id')->count('student_id'),
            'unique_courses' => $attendanceQuery->distinct('course_id')->count('course_id')
        ];

        return view('admin_attendance', [
            'attendance' => $attendance,
            'courses' => Course::all(),
            'students' => Student::all(),
            'stats' => $stats
        ]);
    }
}
