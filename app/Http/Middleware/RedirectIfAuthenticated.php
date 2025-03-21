<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return match ($guard) {
                    'admin' => redirect()->route('admin.dashboard'),
                    'teacher' => redirect()->route('teacher.dashboard'),
                    'student' => redirect()->route('student.dashboard'),
                    default => redirect('/'),
                };
            }
        }

        return $next($request);
    }
}
