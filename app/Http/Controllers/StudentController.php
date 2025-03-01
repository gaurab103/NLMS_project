<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $courseFilter = $request->input('course');

        $students = Student::query()
            ->when($search, fn($q) => $q->where('name', 'like', "%$search%"))
            ->when($courseFilter, fn($q) => $q->where('C_ID', $courseFilter))
            ->with('course')
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        $courses = Course::all();

        return view('studentmanagement', compact('students', 'courses', 'search', 'courseFilter'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'required|string|max:255',
            'parent_name' => 'required|string|max:255',
            'contact_no' => 'required|digits_between:10,15',
            'email' => 'required|email|unique:students,Email',
            'course_id' => 'required|exists:courses,id',
            'stats' => 'required|in:Active,Inactive',
            'username' => 'required|string|max:255|unique:students,Username',
            'password' => 'required|string|min:8',
        ]);

        $photoPath = $request->file('photo')->store('students', 'public');

        Student::create([
            'A_ID' => auth()->guard('admin')->id(),
            'C_ID' => $request->course_id,
            'name' => $request->name,
            'dob' => $request->dob,
            'photo' => $photoPath,
            'Address' => $request->address,
            'Parent_Name' => $request->parent_name,
            'Contact_No' => $request->contact_no,
            'Email' => $request->email,
            'Stats' => $request->stats,
            'Username' => $request->username,
            'Password' => Hash::make($request->password),
        ]);

        return redirect()->route('students.index')->with('success', 'Student added successfully!');
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'required|string|max:255',
            'parent_name' => 'required|string|max:255',
            'contact_no' => 'required|digits_between:10,15',
            'email' => ['required','email',Rule::unique('students','Email')->ignore($student->id)],
            'course_id' => 'required|exists:courses,id',
            'stats' => 'required|in:Active,Inactive',
            'username' => ['required','string','max:255',Rule::unique('students','Username')->ignore($student->id)],
            'password' => 'nullable|string|min:8',
        ]);

        $data = $request->only([
            'name', 'dob', 'address', 'parent_name',
            'contact_no', 'email', 'course_id', 'stats', 'username'
        ]);

        if ($request->hasFile('photo')) {
            Storage::delete('public/'.$student->photo);
            $data['photo'] = $request->file('photo')->store('students', 'public');
        }

        if ($request->filled('password')) {
            $data['Password'] = Hash::make($request->password);
        }

        $student->update($data);

        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        if ($student->photo) {
            Storage::delete('public/'.$student->photo);
        }
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }
}
