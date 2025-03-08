<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

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
        ], [
            'username.required' => 'Enter username',
            'password.required' => 'Enter password',
        ]);

        $admin = Admin::where('Username', $credentials['username'])->first();

        if (!$admin) {
            return back()->withErrors(['username' => 'Username is incorrect']);
        }
        if ($admin->Password !== $credentials['password']) {
            return back()->withErrors(['password' => 'Password is incorrect']);
        }
        Auth::guard('admin')->login($admin);
        return redirect()->route('admin.dashboard');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
