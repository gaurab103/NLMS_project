<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Note; // Assuming a Note model exists
use App\Models\Assignment; // Assuming an Assignment model exists
use App\Models\Message; // Assuming a Message model exists
use App\Models\Subject; // Assuming a Subject model exists
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentsController extends Controller
{
    public function index()
    {
        return view ('layout');
    }

    public function profile()
    {
        try {
            $student = Student::select([
                'id',
                'name',
                'C_ID',
                'A_ID',
                'Address',
                'Parent_Name',
                'Contact_No',
                'Email',
                'Stats'
            ])
            ->where('id', 1)
            ->first();

            if (!$student) {
                return view('profile', ['error' => 'Student not found']);
            }

            // Fetch additional data
            $notes = Note::where('student_id', $student->id)->get();
            $assignments = Assignment::where('student_id', $student->id)->get();
            $messages = Message::where('student_id', $student->id)->get();
            $subjects = Subject::where('student_id', $student->id)->get();

            return view('profile', compact('student', 'notes', 'assignments', 'messages', 'subjects'));
        } catch (\Exception $e) {
            return view('profile', ['error' => 'Error loading profile data: ' . $e->getMessage()]);
        }
    }

    public function editpro($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return redirect()->route('profile')->with('error', 'Student not found.');
        }

        return view('profileedit', compact('student'));
    }

    public function updatepro(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $id,
            'Contact_No' => 'required|string|max:15',
            'Address' => 'required|string|max:500',
            'Parent_Name' => 'required|string|max:255',
        ]);

        $student->update($request->all());

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }
}
