<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (session('student_role') !== $role) {
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}