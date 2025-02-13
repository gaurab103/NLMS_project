<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt([
            'username' => $credentials['username'],
            'password' => $credentials['password']
        ])) {
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['username' => 'Invalid username']);
        return back()->withErrors(['password' => 'Invalid password']);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/login/admin');
    }
}
