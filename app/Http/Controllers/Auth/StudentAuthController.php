<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Notes;
use App\Models\Attendance;

class StudentAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.student-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $student = Student::where('Username', $credentials['username'])->first();

        if ($student && Hash::check($credentials['password'], $student->Password)) {
            Auth::guard('student')->login($student);
            return redirect()->route('student.dashboard');
        }

        return back()->withErrors(['username' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::guard('student')->logout();
        return redirect('/');
    }
    public function profile()
    {
        try {
            $student = Auth::guard('student')->user();

            if (!$student) {
                return view('profile', ['error' => 'Student not found']);
            }

        
            return view('profile', compact('student'));
        } catch (\Exception $e) {
            return view('profile', ['error' => 'Error loading profile data: ' . $e->getMessage()]);
        }
    }

    public function editpro()
    {
        $student = Auth::guard('student')->user();

        if (!$student) {
            return redirect()->route('profile')->with('error', 'Student not found.');
        }

        return view('profileedit', compact('student'));
    }

    public function updatepro(Request $request)
    {
        $student = Auth::guard('student')->user();

        if (!$student) {
            return redirect()->route('profile')->with('error', 'Student not found.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'Contact_No' => 'required|string|max:15',
            'Address' => 'required|string|max:500',
            'Parent_Name' => 'required|string|max:255',
        ]);

        $student->update($request->all());

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }
}
