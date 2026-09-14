<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminLogin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is logged in via session
        if (!$request->session()->has('student_id')) {
            return redirect()->route('login');
        }

        // Check admin role
        if ($request->session()->get('student_role') !== 'admin') {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}