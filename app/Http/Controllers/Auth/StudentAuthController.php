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

        if ($student && $credentials['password'] === $student->Password) {
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

public function fetchAttendance()
{
    $student = Auth::guard('student')->user();

    if (!$student) {
        return response()->json([
            'success' => false,
            'message' => 'User not authenticated',
        ]);
    }

    $attendance = Attendance::where('Std_ID', $student->id)->get();

    return response()->json([
        'success' => true,
        'data' => $attendance,
    ]);
}

}
