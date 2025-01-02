<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Log;

class StudentsController extends Controller
{
    // Display student portal
    public function index()
    {
        return view("layout");
    }

    // Show student profile
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

            return view('profile')->with('student', $student);
        } catch (\Exception $e) {
            Log::error('Error fetching student profile: ' . $e->getMessage());
            return view('portal', ['error' => 'Error loading student data. Please try again later.']);
        }
    }

    public function editpro($id)
    {
        try {
            $student = Student::findOrFail($id);
            return view('profileedit', compact('student'));
        } catch (\Exception $e) {
            Log::error('Error fetching student for editing: ' . $e->getMessage());
            return redirect()->route('profile')->with('error', 'Student not found.');
        }
    }

    // Update student profile
    public function updatepro(Request $request, $id)
    {
        Log::info('Update profile route hit');
        try {
            // Log incoming request data for debugging
            Log::info('Update request data:', $request->all());

            // Validate the incoming request data
            $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'parent_name' => 'required|string|max:255',
                'contact_no' => 'required|string|max:20',
                'email' => 'required|email|max:255',
            ]);

            // Find the student by ID
            $student = Student::findOrFail($id);

            // Update the student's details
            $student->update([
                'name' => $request->input('name'),
                'Address' => $request->input('address'),
                'Parent_Name' => $request->input('parent_name'),
                'Contact_No' => $request->input('contact_no'),
                'Email' => $request->input('email'),
            ]);

            // Redirect back to the profile with a success message
            return redirect()->route('profile')->with('success', 'Profile updated successfully.');

        } catch (\Exception $e) {
            // Log the error and redirect with an error message if something goes wrong
            Log::error('Error updating student profile: ' . $e->getMessage());
            return redirect()->route('profile')->with('error', 'Error updating profile.');
        }
    }
}
