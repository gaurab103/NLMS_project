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
        // Get filtered attendance records
        $attendance = Attendance::with(['student', 'course'])
            ->when($request->course_id, fn($q) => $q->where('course_id', $request->course_id))
            ->when($request->student_id, fn($q) => $q->where('student_id', $request->student_id))
            ->when($request->date, fn($q) => $q->whereDate('date', $request->date))
            ->when($request->daterange, function ($q) use ($request) {
                $dates = explode(' - ', $request->daterange);
                $q->whereBetween('date', [
                    Carbon::parse($dates[0])->startOfDay(),
                    Carbon::parse($dates[1])->endOfDay()
                ]);
            })
            ->orderByDesc('date')
            ->paginate(30);

        // Calculate statistics correctly
        $todayRecords = Attendance::whereDate('date', today())->get();
        $weeklyRecords = Attendance::whereBetween('date', [now()->subDays(7), now()])->get();
        $monthlyRecords = Attendance::whereBetween('date', [now()->subDays(30), now()])->get();

        $stats = [
            'today' => $todayRecords->count(),
            'weekly' => $this->calculateAverage($weeklyRecords),
            'monthly' => $this->calculateAverage($monthlyRecords)
        ];

        return view('admin_attendance', [
            'attendance' => $attendance,
            'courses' => Course::all(),
            'students' => Student::all(),
            'stats' => $stats
        ]);
    }

    private function calculateAverage($records)
    {
        if ($records->isEmpty()) return 0;

        $presentCount = $records->filter(fn($record) => $record->status === 'present')->count();
        return $presentCount / $records->count();
    }
}
