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
        // Build the query for filtering and searching
        $query = Student::with('course');

        // Search by name if the search input is provided
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter by course if a course_id is provided
        if ($request->filled('course_id')) {
            $query->where('C_ID', $request->course_id);
        }

        $students = $query->orderBy('name')->paginate(10);
        $courses  = Course::all();
        return view('studentmanagement', compact('students', 'courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'dob'          => 'required|date',
            'parent_name'  => 'required|string|max:255',
            'address'      => 'required|string|max:500',
            'contact_no'   => 'required|string|max:15',
            'email'        => 'required|email|unique:students,Email',
            'course_id'    => 'required|exists:courses,id',
            'stats'        => 'required|in:Active,Inactive',
            'username'     => 'required|unique:students,Username',
            'password'     => 'required|min:8',
            'photo'        => 'required|image|max:2048',
        ]);

        $photoPath = $request->file('photo')->store('students', 'public');

        // Store password as plain text (for demonstration only)
        Student::create([
            'name'         => $validated['name'],
            'dob'          => $validated['dob'],
            'Parent_Name'  => $validated['parent_name'],
            'Address'      => $validated['address'],
            'Contact_No'   => $validated['contact_no'],
            'Email'        => $validated['email'],
            'C_ID'         => $validated['course_id'],
            'Stats'        => $validated['stats'],
            'Username'     => $validated['username'],
            'Password'     => $validated['password'],
            'photo'        => $photoPath,
        ]);

        return redirect()->route('students.index')->with('success', 'Student created successfully');
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'dob'          => 'required|date',
            'parent_name'  => 'required|string|max:255',
            'address'      => 'required|string|max:500',
            'contact_no'   => 'required|string|max:15',
            'email'        => 'required|email|unique:students,Email,' . $student->id,
            'course_id'    => 'required|exists:courses,id',
            'stats'        => 'required|in:Active,Inactive',
            'username'     => 'required|unique:students,Username,' . $student->id,
            'password'     => 'nullable|min:8',
            'photo'        => 'nullable|image|max:2048',
        ]);

        $updateData = [
            'name'         => $validated['name'],
            'dob'          => $validated['dob'],
            'Parent_Name'  => $validated['parent_name'],
            'Address'      => $validated['address'],
            'Contact_No'   => $validated['contact_no'],
            'Email'        => $validated['email'],
            'C_ID'         => $validated['course_id'],
            'Stats'        => $validated['stats'],
            'Username'     => $validated['username'],
        ];

        if ($request->hasFile('photo')) {
            Storage::delete('public/' . $student->photo);
            $updateData['photo'] = $request->file('photo')->store('students', 'public');
        }

        if ($validated['password']) {
            $updateData['Password'] = $validated['password'];
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
