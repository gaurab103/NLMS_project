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
            'subject'      => 'required|string|max:255',
            'email'        => 'required|email|unique:teachers,Email',
            'phone_number' => 'required|digits_between:10,15',
            'address'      => 'required|string|max:255',
            'username'     => 'required|string|max:255|unique:teachers,Username',
            'password'     => 'required|string|max:255',
        ]);

        // Use the currently logged-in admin's ID instead of hardcoding "1"
        $adminId = auth()->guard('admin')->id();

        Teacher::create([
            'A_ID'         => $adminId,
            'Teacher_Name' => $request->teacher_name,
            'Subject'      => $request->subject,
            'Email'        => $request->email,
            'Phone_Number' => $request->phone_number,
            'Address'      => $request->address,
            'Username'     => $request->username,
            'Password'     => $request->password, // Will be hashed by the model mutator.
            'Status'       => true,
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
            'subject'      => 'required|string|max:255',
            'email'        => 'required|email|unique:teachers,Email,' . $teacher->id,
            'phone_number' => 'required|digits_between:10,15',
            'address'      => 'required|string|max:255',
            'username'     => 'required|string|max:255|unique:teachers,Username,' . $teacher->id,
            'password'     => 'nullable|string|max:255',
        ]);

        $updateData = [
            'Teacher_Name' => $request->teacher_name,
            'Subject'      => $request->subject,
            'Email'        => $request->email,
            'Phone_Number' => $request->phone_number,
            'Address'      => $request->address,
            'Username'     => $request->username,
        ];

        if ($request->filled('password')) {
            $updateData['Password'] = $request->password;
        }

        $teacher->update($updateData);

        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully.');
    }

    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully.');
    }
}
