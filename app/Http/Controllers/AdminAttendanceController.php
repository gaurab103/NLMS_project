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

        // Calculate statistics
        $todayRecords = Attendance::whereDate('date', today())->get();
        $monthlyRecords = Attendance::whereBetween('date', [now()->subDays(30), now()])->get();

        $stats = [
            'today' => $todayRecords->count(),
            'absences' => $todayRecords->where('status', 'absent')->count(),
            'monthly' => $this->calculateAverage($monthlyRecords),
            'class_avg' => $this->calculateClassAverage($request)
        ];

        return view('admin_attendance', [
            'attendance' => $attendance,
            'courses' => Course::all(),
            'students' => Student::all(),
            'stats' => $stats
        ]);
    }

    private function calculateClassAverage(Request $request)
    {
        return Course::withCount(['attendances as present_count' => function($q) {
                $q->where('status', 'present');
            }])
            ->when($request->filled('daterange'), function($q) use ($request) {
                $dates = explode(' - ', $request->daterange);
                $q->whereHas('attendances', function($q) use ($dates) {
                    $q->whereBetween('date', [
                        Carbon::parse($dates[0])->startOfDay(),
                        Carbon::parse($dates[1])->endOfDay()
                    ]);
                });
            })
            ->get()
            ->avg(function($course) {
                return $course->present_count / max($course->attendances_count, 1);
            });
    }

    private function calculateAverage($records)
    {
        if ($records->isEmpty()) return 0;

        $presentCount = $records->filter(fn($record) => $record->status === 'present')->count();
        return $presentCount / $records->count();
    }
}
