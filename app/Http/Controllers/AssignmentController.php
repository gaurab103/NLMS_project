<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Course;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class AssignmentController extends Controller
{
    public function index()
    {
        $teacherId = Auth::guard('teacher')->id();

        $assignments = Assignment::with(['subject', 'course', 'submissions'])
            ->where('teacher_id', $teacherId)
            ->latest()
            ->get();

        $classes = Course::whereHas('subjects', function($query) use ($teacherId) {
                $query->where('teacher_id', $teacherId);
            })->get();

        $subjects = Subject::where('teacher_id', $teacherId)->get();

        return view('assignmentportalteacher', [
            'assignments' => $assignments,
            'classes' => $classes,
            'subjects' => $subjects,
            'active' => 'assignments'
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|max:2048',
            'due_date' => 'required|date',
            'class_id' => 'required|exists:courses,id',
            'subject_id' => 'required|exists:subjects,id'
        ]);

        $filePath = $request->hasFile('file')
            ? $request->file('file')->store('assignments', 'public')
            : null;

        Assignment::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'file_path' => $filePath,
            'due_date' => $validated['due_date'],
            'course_id' => $validated['class_id'],
            'subject_id' => $validated['subject_id'],
            'teacher_id' => Auth::guard('teacher')->id()
        ]);

        return redirect()->route('assignments.index')
            ->with('success', 'Assignment created successfully');
    }

    public function edit(Assignment $assignment)
    {
        $teacherId = Auth::guard('teacher')->id();
        if ($assignment->teacher_id !== $teacherId) {
            abort(Response::HTTP_FORBIDDEN, 'Unauthorized action.');
        }

        $classes = Course::whereHas('subjects', function($query) use ($teacherId) {
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
            abort(Response::HTTP_FORBIDDEN, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|max:2048',
            'due_date' => 'required|date',
            'class_id' => 'required|exists:courses,id',
            'subject_id' => 'required|exists:subjects,id'
        ]);

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
            'course_id' => $validated['class_id'],
            'subject_id' => $validated['subject_id']
        ]);

        return redirect()->route('assignments.index')
            ->with('success', 'Assignment updated successfully');
    }

    public function destroy(Assignment $assignment)
    {
        $teacherId = Auth::guard('teacher')->id();
        if ($assignment->teacher_id !== $teacherId) {
            abort(Response::HTTP_FORBIDDEN, 'Unauthorized action.');
        }

        if ($assignment->file_path) {
            Storage::disk('public')->delete($assignment->file_path);
        }

        $assignment->delete();
        return redirect()->route('assignments.index')
            ->with('success', 'Assignment deleted successfully');
    }

    public function show(Assignment $assignment)
    {
        $teacherId = Auth::guard('teacher')->id();
        if ($assignment->teacher_id !== $teacherId) {
            abort(Response::HTTP_FORBIDDEN, 'Unauthorized action.');
        }

        $selectedAssignment = $assignment->load('submissions.student');
        $assignments = Assignment::with(['subject', 'course', 'submissions'])
            ->where('teacher_id', $teacherId)
            ->latest()
            ->get();
        $classes = Course::all();
        $subjects = Subject::where('teacher_id', $teacherId)->get();
        return view('assignmentportalteacher', [
            'selectedAssignment' => $selectedAssignment,
            'assignments' => $assignments,
            'classes' => $classes,
            'subjects' => $subjects,
            'active' => 'assignments' // Highlights "Assignments" in nav
        ]);
    }
}
