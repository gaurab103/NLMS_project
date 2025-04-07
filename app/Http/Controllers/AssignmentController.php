<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Course;
use App\Models\Subject;
use App\Models\AssignmentSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    public function index()
    {
        $teacherId = Auth::guard('teacher')->id();
        $assignments = Assignment::with(['subject', 'course', 'submissions'])
                                 ->where('teacher_id', $teacherId)
                                 ->latest()
                                 ->get();
        $classes = Course::whereHas('subjects', function ($query) use ($teacherId) {
            $query->where('teacher_id', $teacherId);
        })->get();

        return view('assignmentportalteacher', [
            'assignments' => $assignments,
            'classes' => $classes,
            'active' => 'assignments'
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|max:2048|mimes:pdf,doc,docx',
            'due_date' => 'required|date|after:now',
            'max_marks' => 'required|integer|min:1',
            'class_id' => 'required|exists:courses,id',
            'subject_id' => 'required|exists:subjects,id'
        ]);

        $teacherId = Auth::guard('teacher')->id();

        // Check if the subject belongs to the teacher and matches the class
        $subject = Subject::where('id', $validated['subject_id'])
                          ->where('teacher_id', $teacherId)
                          ->where('course_id', $validated['class_id'])
                          ->first();

        if (!$subject) {
            return back()->withErrors(['subject_id' => 'You are not authorized to add assignments for this subject or class.'])->withInput();
        }

        $filePath = $request->hasFile('file')
            ? $request->file('file')->store('assignments', 'public')
            : null;

        Assignment::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'file_path' => $filePath,
            'due_date' => $validated['due_date'],
            'max_marks' => $validated['max_marks'],
            'course_id' => $validated['class_id'],
            'subject_id' => $validated['subject_id'],
            'teacher_id' => $teacherId
        ]);

        return redirect()->route('assignments.index')->with('success', 'Assignment created successfully');
    }

    public function edit(Assignment $assignment)
    {
        $teacherId = Auth::guard('teacher')->id();
        if ($assignment->teacher_id !== $teacherId) {
            abort(403, 'Unauthorized action.');
        }

        $classes = Course::whereHas('subjects', function ($query) use ($teacherId) {
            $query->where('teacher_id', $teacherId);
        })->get();
        $subjects = Subject::where('teacher_id', $teacherId)->get();

        return view('assignmentportalteacher', [
            'assignment' => $assignment,
            'classes' => $classes,
            'subjects' => $subjects,
            'active' => 'assignments'
        ]);
    }

    public function update(Request $request, Assignment $assignment)
    {
        $teacherId = Auth::guard('teacher')->id();
        if ($assignment->teacher_id !== $teacherId) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|max:2048|mimes:pdf,doc,docx',
            'due_date' => 'required|date|after:now',
            'max_marks' => 'required|integer|min:1',
            'class_id' => 'required|exists:courses,id',
            'subject_id' => 'required|exists:subjects,id'
        ]);

        // Check if the subject belongs to the teacher and matches the class
        $subject = Subject::where('id', $validated['subject_id'])
                          ->where('teacher_id', $teacherId)
                          ->where('course_id', $validated['class_id'])
                          ->first();

        if (!$subject) {
            return back()->withErrors(['subject_id' => 'You are not authorized to update assignments for this subject or class.'])->withInput();
        }

        if ($request->hasFile('file')) {
            if ($assignment->file_path) {
                Storage::disk('public')->delete($assignment->file_path);
            }
            $filePath = $request->file('file')->store('assignments', 'public');
        } else {
            $filePath = $assignment->file_path;
        }

        $assignment->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'file_path' => $filePath,
            'due_date' => $validated['due_date'],
            'max_marks' => $validated['max_marks'],
            'course_id' => $validated['class_id'],
            'subject_id' => $validated['subject_id']
        ]);

        return redirect()->route('assignments.index')->with('success', 'Assignment updated successfully');
    }

    public function destroy(Assignment $assignment)
    {
        $teacherId = Auth::guard('teacher')->id();
        if ($assignment->teacher_id !== $teacherId) {
            abort(403, 'Unauthorized action.');
        }

        if ($assignment->file_path) {
            Storage::disk('public')->delete($assignment->file_path);
        }

        $assignment->delete();
        return redirect()->route('assignments.index')->with('success', 'Assignment deleted successfully');
    }

    public function showSubmissions(Assignment $assignment)
    {
        $teacherId = Auth::guard('teacher')->id();
        if ($assignment->teacher_id !== $teacherId) {
            abort(403, 'Unauthorized action.');
        }

        $submissions = $assignment->submissions()->with('student')->get();
        return view('assignment_submissions', [
            'assignment' => $assignment,
            'submissions' => $submissions,
            'active' => 'assignments'
        ]);
    }

    public function evaluateSubmission(Request $request, AssignmentSubmission $submission)
    {
        $teacherId = Auth::guard('teacher')->id();
        if ($submission->assignment->teacher_id !== $teacherId) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'marks_obtained' => 'required|integer|min:0|max:' . $submission->assignment->max_marks
        ]);

        $submission->update(['marks_obtained' => $validated['marks_obtained']]);
        return redirect()->back()->with('success', 'Marks updated successfully');
    }
    public function showForStudent(Request $request, Assignment $assignment)
{
    $studentId = Auth::guard('student')->id();

    if (!$studentId) {
        return redirect()->route('login')->with('error', 'Please log in to view assignments.');
    }

    $submission = $assignment->submissions()
        ->where('student_id', $studentId)
        ->first();

    $assignments = Assignment::with(['subject', 'course', 'submissions' => function ($query) use ($studentId) {
            $query->where('student_id', $studentId);
        }])
        ->latest()
        ->get();

    $classes = Course::all();
    $subjects = Subject::all();

    return view('assignments', compact(
        'assignment', 
        'submission', 
        'assignments', 
        'classes', 
        'subjects'
    ))->with('active', 'assignments');
}
}
