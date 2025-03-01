<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class TeacherAttendanceController extends Controller
{
    public function create()
    {
        $courses = Course::select('id', 'name')->get();
        return view('teacher_attendance', compact('courses'));
    }

    public function getStudents(Course $course, Request $request)
{
    $request->validate(['date' => 'required|date']);

    $date = $request->query('date');

        $students = $course->students()
            ->with(['attendances' => function($query) use ($date) {
                $query->whereDate('date', $date);
            }])
            ->select('id', 'name') // Limit fields retrieved
            ->paginate(30); // Add pagination


    return response()->json($students);
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'course_id' => 'required|exists:courses,id',
            'students' => 'required|array'
        ]);

        foreach ($request->students as $studentId => $data) {
            // Consider using chunking if the number of students is large
            Attendance::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'course_id' => $request->course_id,
                    'date' => $request->date
                ],
                ['status' => $data['status']]
            );
        }

        return redirect()->back()->with('success', 'Attendance saved successfully!');
    }
}
