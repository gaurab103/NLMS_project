<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Assignment;
use Illuminate\Http\Request;
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
            'subject' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,Email',
            'phone_number' => 'required|digits_between:10,15',
            'address' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:teachers,Username',
            'password' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $adminId = auth()->guard('admin')->id();
        if (!$adminId) {
            return redirect()->back()->with('error', 'Admin not logged in.');
        }

        $photoPath = $request->file('photo')->store('teachers', 'public');

        Teacher::create([
            'A_ID' => $adminId,
            'Teacher_Name' => $request->teacher_name,
            'Subject' => $request->subject,
            'Email' => $request->email,
            'Phone_Number' => $request->phone_number,
            'Address' => $request->address,
            'Username' => $request->username,
            'Password' => $request->password,
            'Status' => true,
            'Photo' => $photoPath,
        ]);

        return redirect()->route('teachers.index')->with('success', 'Teacher added successfully.');
    }

    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);

        $request->validate([
            'teacher_name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,Email,' . $teacher->id,
            'phone_number' => 'required|digits_between:10,15',
            'address' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:teachers,Username,' . $teacher->id,
            'password' => 'nullable|string|max:255',
            'status' => 'nullable|boolean',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $updateData = [
            'Teacher_Name' => $request->teacher_name,
            'Subject' => $request->subject,
            'Email' => $request->email,
            'Phone_Number' => $request->phone_number,
            'Address' => $request->address,
            'Username' => $request->username,
        ];

        if ($request->filled('password')) {
            $updateData['Password'] = $request->password;
        }

        if ($request->hasFile('photo')) {
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

    public function createAssignment()
    {
        $teacher = auth()->guard('teacher')->user();
        $classes = Course::whereHas('subjects', function($query) use ($teacher) {
            $query->where('teacher_id', $teacher->id);
        })->get();
        $subjects = Subject::where('teacher_id', $teacher->id)->get();

        return view('assignmentportalteacher', compact('classes', 'subjects'));
    }

    public function storeAssignment(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:courses,id',
            'subject_id' => 'required|exists:subjects,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
        ]);

        $subject = Subject::where('id', $request->subject_id)
            ->where('teacher_id', auth()->guard('teacher')->id())
            ->firstOrFail();

        Assignment::create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'subject_id' => $request->subject_id,
            'course_id' => $request->class_id,
            'teacher_id' => auth()->guard('teacher')->id(),
        ]);

        return redirect()->back()->with('success', 'Assignment created successfully');
    }

    public function viewSubmissions()
    {
        $assignments = Assignment::with(['submissions.student'])
            ->where('teacher_id', auth()->guard('teacher')->id())
            ->get();
        return view('assignment_submissions', compact('assignments'));
    }
}
