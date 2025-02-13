<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (!Auth::guard($guard)->check()) {
                return redirect()->guest(
                    match ($guard) {
                        'admin' => route('admin.login'),
                        'teacher' => route('teacher.login'),
                        'student' => route('student.login'),
                        default => route('login'),
                    }
                );
            }
        }

        return $next($request);
    }
}
