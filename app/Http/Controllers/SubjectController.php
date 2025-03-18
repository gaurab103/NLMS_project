<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Course;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'teacher_id' => 'required|exists:teachers,id',
            'course_id' => 'required|exists:courses,id',  // Corrected 'class_id' to 'course_id'
            'description' => 'nullable|string'
        ]);

        try {
            Subject::create([
                'name' => $request->name,
                'description' => $request->description,
                'course_id' => $request->course_id,  // Corrected 'class_id' to 'course_id'
                'teacher_id' => $request->teacher_id,
                'admin_id' => auth('admin')->id()
            ]);

            return redirect()->back()->with('success', 'Subject created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error creating subject: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'teacher_id' => 'required|exists:teachers,id'
        ]);

        $subject->update($request->all());
        return redirect()->back()->with('success', 'Subject updated successfully');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->back()->with('success', 'Subject deleted successfully');
    }

    public function show(Course $course, Subject $subject)
    {
        // Ensure the subject belongs to the specified course
        if ($subject->course_id != $course->id) {
            abort(404);
        }

        // Eager load relationships to avoid N+1 queries
        $subject->load([
            'teacher',
            'course.students',
            'notes.teacher',
            'assignments.submissions.student'
        ]);

        return view('subject_details', compact('subject', 'course'));
    }

    public function studentshow(Course $course)
    {
        if (!$course) {
            dd('Course not found');
        }
    
        $course->load('subjects');
    
        dd($course->subjects);
    
        return view('subjects', [
            'course' => $course,
            'subjects' => $course->subjects
        ]);
    }
    
}
