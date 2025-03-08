<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;

class TeacherAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.teacher-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $teacher = Teacher::where('username', $credentials['username'])->first();

        if ($teacher && $teacher->Password === $credentials['password']) {
            Auth::guard('teacher')->login($teacher);
            return redirect()->route('teacher.dashboard');
        }

        return back()->withErrors(['username' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::guard('teacher')->logout();
        return redirect('/');
    }
}
