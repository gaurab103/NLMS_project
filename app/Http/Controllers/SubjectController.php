<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;


class SubjectController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'teacher_id' => 'required|exists:teachers,id',
            'class_id' => 'required|exists:courses,id',
            'description' => 'nullable|string'
        ]);

        Subject::create([
            'name' => $request->name,
            'description' => $request->description,
            'course_id' => $request->class_id,
            'teacher_id' => $request->teacher_id,
            'admin_id' => auth('admin')->id()
        ]);

        return redirect()->back()->with('success', 'Subject created successfully');
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'teacher_id' => 'required|exists:teachers,id',
            'description' => 'nullable|string'
        ]);

        $subject->update($request->only(['name', 'teacher_id', 'description']));
        return redirect()->back()->with('success', 'Subject updated successfully');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->back()->with('success', 'Subject deleted successfully');
    }

    public function show(Course $class, Subject $subject)
    {
        if ($subject->course_id != $class->id) {
            abort(404);
        }
        $subject->load([
            'notes.teacher',
            'assignments.submissions.student',
            'teacher',
            'course.students'
        ]);
        return view('subject_details', compact('subject', 'class'));
    }
    public function studentshow()
    {
        // Fetch the logged-in student
        $studentId = Auth::guard('student')->id();

        if (!$studentId) {
            return redirect()->route('login')->with('error', 'Please log in to view your subjects.');
        }

        // Fetch the course(s) the student is enrolled in from the students table
        $student = Student::find($studentId);

        // Fetch the courses the student is enrolled in
        $courses = Course::where('id', $student->course_id)->get();

        // Fetch the subjects for those courses
        $subjects = Subject::whereIn('course_id', $courses->pluck('id'))->get();

        // Return the view with the subjects and courses
        return view('subjects', compact('subjects', 'courses'));
    }
}
