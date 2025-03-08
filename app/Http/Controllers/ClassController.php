<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        $classes = Course::with(['subjects.teacher'])
            ->withCount('subjects')
            ->where('A_ID', auth('admin')->id())
            ->get();
        $teachers = Teacher::all();

        return view('classmanagement', compact('classes', 'teachers'));
    }

    public function store(Request $request)
    {
        $request->validate(['course_name' => 'required|string|max:255']);

        Course::create([
            'course_name' => $request->course_name,
            'A_ID' => auth('admin')->id()
        ]);

        return redirect()->back()->with('success', 'Class created successfully');
    }

    public function update(Request $request, Course $class)
    {
        $request->validate(['course_name' => 'required|string|max:255']);
        $class->update($request->only('course_name'));
        return redirect()->back()->with('success', 'Class updated successfully');
    }

    public function destroy(Course $class)
    {
        $class->delete();
        return redirect()->back()->with('success', 'Class deleted successfully');
    }

    public function show(Course $class)
    {
        $class->load(['subjects.teacher', 'students']);
        return view('class_details', compact('class'));
    }
}
