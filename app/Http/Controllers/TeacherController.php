<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();
        return view('teachersmanagement', compact('teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'teacher_name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email',
            'phone_number' => 'required|digits_between:10,15',
            'address' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);

        Teacher::create([
            'A_ID' => 1,
            'Teacher_Name' => $request->teacher_name,
            'Subject' => $request->subject,
            'Email' => $request->email,
            'Phone_Number' => $request->phone_number,
            'Address' => $request->address,
            'Username' => $request->username,
            'Password' => ($request->password), // Encrypt password
            'Status' => true,
        ]);

        return redirect()->route('teachers.index')->with('success', 'Teacher added successfully.');
    }

    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        return response()->json($teacher);
    }

    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);

        $request->validate([
            'teacher_name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email,' . $teacher->id,
            'phone_number' => 'required|digits_between:10,15',
            'address' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'nullable|string|max:255',
        ]);

        $teacher->update([
            'Teacher_Name' => $request->teacher_name,
            'Subject' => $request->subject,
            'Email' => $request->email,
            'Phone_Number' => $request->phone_number,
            'Address' => $request->address,
            'Username' => $request->username,
            'Password' => $request->password ? ($request->password) : $teacher->Password,
        ]);

        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully.');
    }

    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully.');
    }
}
