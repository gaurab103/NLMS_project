<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Log;

class StudentsController extends Controller
{
    // Display the student portal
    public function index()
    {
        return view('layout');
    }

    // Show the student profile
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
                return view('profile')->with('error', 'Student not found.');
            }

            return view('profile', compact('student'));
        } catch (\Exception $e) {
            Log::error('Error fetching student profile: ' . $e->getMessage());
            return view('profile', ['error' => 'Error loading student data. Please try again later.']);
        }
    }

    // Edit the student profile
    public function editpro($id)
{
    try {
        $student = Student::findOrFail($id); // Fetch student by ID
        return view('profileedit', compact('student')); // Pass student data to view
    } catch (\Exception $e) {
        Log::error('Error fetching student for editing: ' . $e->getMessage());
        return redirect()->route('profile')->with('error', 'Student not found.');
    }
}


    // Update the student profile
    public function updatepro(Request $request, $id)
    {
        Log::info('Update profile route hit');
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'parent_name' => 'required|string|max:255',
                'contact_no' => 'required|string|max:20',
                'email' => 'required|email|max:255',
            ]);

            $student = Student::findOrFail($id);
            Log::info('Student before update:', $student->toArray());

            $student->update([
                'name' => $request->input('name'),
                'Address' => $request->input('address'),
                'Parent_Name' => $request->input('parent_name'),
                'Contact_No' => $request->input('contact_no'),
                'Email' => $request->input('email'),
            ]);

            Log::info('Student after update:', $student->toArray());

            return redirect()->route('profile')->with('success', 'Profile updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating student profile: ' . $e->getMessage());
            return redirect()->route('profile')->with('error', 'Error updating profile.');
        }
    }
}
