<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckStudentLogin
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('student_id')) {

            // Jahan jaana tha wahi URL save kar lein (login ke baad wapis wahi jayein)
            Session::put('intended_url', $request->fullUrl());

            // Alert message
            Session::flash('login_alert', 'Please login first');

            return redirect()->route('login');
        }

        return $next($request);
    }
}