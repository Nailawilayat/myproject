<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('student_id')) {

            // Agar login page pe bhejna hai to redirect kar dein:
            return redirect()->route('login')
                ->with('error', 'Please login first to access this page.');

            // Agar 403 error dikhana hai to upar wali line hata kar ye use karein:
            // abort(403, 'User is not logged in.');
        }

        return $next($request);
    }
}