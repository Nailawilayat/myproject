<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $studentId = $request->session()->get('student_id');
        $role = $request->session()->get('student_role');

        if (!$studentId || !$role) {
            return redirect()->route('login')->withErrors([
                'email' => 'Please login first.'
            ]);
        }

        if (!in_array($role, $roles, true)) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}