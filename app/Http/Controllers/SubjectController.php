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
}
