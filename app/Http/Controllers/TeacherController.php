<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $teachers = Teacher::query()
            ->when($request->search, function($query) use ($request) {
                $query->where(function($q) use ($request) {
                    $q->where('Teacher_Name', 'like', '%'.$request->search.'%')
                      ->orWhere('Subject', 'like', '%'.$request->search.'%')
                      ->orWhere('Email', 'like', '%'.$request->search.'%')
                      ->orWhere('Username', 'like', '%'.$request->search.'%');
                });
            })
            ->when($request->has('status'), function($query) use ($request) {
                $query->where('Status', $request->status);
            })
            ->orderBy('Teacher_Name')
            ->paginate(10)
            ->withQueryString();

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
            'photo'        => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $adminId = auth()->guard('admin')->id();
        if (!$adminId) {
            return redirect()->back()->with('error', 'Admin not logged in.');
        }

        $photoPath = $request->file('photo')->store('teachers', 'public');

        Teacher::create([
            'A_ID'         => $adminId,
            'Teacher_Name' => $request->teacher_name,
            'Subject'      => $request->subject,
            'Email'        => $request->email,
            'Phone_Number' => $request->phone_number,
            'Address'      => $request->address,
            'Username'     => $request->username,
            'Password'     => $request->password,
            'Status'       => true,
            'Photo'        => $photoPath,
        ]);

        return redirect()->route('teachers.index')->with('success', 'Teacher added successfully.');
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
            'status'       => 'nullable|boolean',
            'photo'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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

        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($teacher->Photo && Storage::disk('public')->exists($teacher->Photo)) {
                Storage::disk('public')->delete($teacher->Photo);
            }
            $updateData['Photo'] = $request->file('photo')->store('teachers', 'public');
        }

        $teacher->update($updateData);

        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully.');
    }

    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);

        if ($teacher->Photo && Storage::disk('public')->exists($teacher->Photo)) {
            Storage::disk('public')->delete($teacher->Photo);
        }

        $teacher->delete();

        return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully.');
    }
}
