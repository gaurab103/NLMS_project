<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::query()->with('course')->orderBy('name');

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('Email', 'like', '%' . $search . '%')
                    ->orWhere('Parent_Name', 'like', '%' . $search . '%')
                    ->orWhere('Contact_No', 'like', '%' . $search . '%')
                    ->orWhere('Username', 'like', '%' . $search . '%')
                    ->orWhere('Address', 'like', '%' . $search . '%');
            });
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('Stats', $request->status);
        }

        if ($request->has('course_id') && $request->course_id != '') {
            $query->where('C_ID', $request->course_id);
        }

        $students = $query->paginate(10);
        $courses = Course::all();

        return view('studentmanagement', compact('students', 'courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'parent_name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'contact_no' => 'required|string|max:15',
            'email' => 'required|email|unique:students,Email',
            'course_id' => 'required|exists:courses,id',
            'stats' => 'required|in:Active,Inactive',
            'username' => 'required|unique:students,Username',
            'password' => 'required|min:8',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $photoPath = $request->file('photo')->store('students', 'public');

        Student::create([
            'name' => $validated['name'],
            'dob' => $validated['dob'],
            'Parent_Name' => $validated['parent_name'],
            'Address' => $validated['address'],
            'Contact_No' => $validated['contact_no'],
            'Email' => $validated['email'],
            'C_ID' => $validated['course_id'],
            'Stats' => $validated['stats'],
            'Username' => $validated['username'],
            'Password' => $validated['password'],
            'photo' => $photoPath,
        ]);

        return redirect()->route('students.index')->with('success', 'Student created successfully');
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'parent_name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'contact_no' => 'required|string|max:15',
            'email' => 'required|email|unique:students,Email,' . $student->id,
            'course_id' => 'required|exists:courses,id',
            'stats' => 'required|in:Active,Inactive',
            'username' => 'required|unique:students,Username,' . $student->id,
            'password' => 'nullable|min:8',
            'photo' => 'nullable|image|max:2048',
        ]);

        $updateData = [
            'name' => $validated['name'],
            'dob' => $validated['dob'],
            'Parent_Name' => $validated['parent_name'],
            'Address' => $validated['address'],
            'Contact_No' => $validated['contact_no'],
            'Email' => $validated['email'],
            'C_ID' => $validated['course_id'],
            'Stats' => $validated['stats'],
            'Username' => $validated['username'],
        ];

        if (!empty($validated['password'])) {
            $updateData['Password'] = $validated['password'];
        }

        if ($request->hasFile('photo')) {
            Storage::delete('public/' . $student->photo);
            $updateData['photo'] = $request->file('photo')->store('students', 'public');
        }

        $student->update($updateData);

        return redirect()->route('students.index')->with('success', 'Student updated successfully');
    }

    public function destroy(Student $student)
    {
        Storage::delete('public/' . $student->photo);
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully');
    }
}
