<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeacherAttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:teacher');
    }

    public function create()
    {
        $courses = Course::all();
        return view('teacher_attendance', compact('courses'));
    }

    public function getStudents(Course $course, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $students = $course->students()
            ->with(['attendances' => function($query) use ($request) {
                $query->whereDate('date', $request->date);
            }])
            ->get(['id', 'name']);

        return response()->json($students);
    }

    public function store(Request $request)
    {
        // Validate request input
        $validated = $request->validate([
            'date' => 'required|date',
            'course_id' => 'required|exists:courses,id',
            'students' => 'required|array'
        ]);

        // Find the course by ID
        $course = Course::findOrFail($validated['course_id']);

        // Iterate through the students and update/create attendance records
        foreach ($validated['students'] as $studentId => $data) {
            $student = Student::findOrFail($studentId);

            // Ensure the student is part of the course
            if (!$course->students->contains($student)) {
                return back()->withErrors(['students' => 'Invalid student for this course']);
            }

            // Update or create the attendance record for the student
            Attendance::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'course_id' => $validated['course_id'],
                    'date' => $validated['date']
                ],
                [
                    'status' => $data['status'], // Store the attendance status (present/absent)
                ]
            );
        }

        // Redirect back with success message
        return redirect()->route('teacher.attendance')
            ->with('success', 'Attendance saved successfully!');
    }
}
