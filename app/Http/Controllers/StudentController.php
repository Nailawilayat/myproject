<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{
    // =====================================================
    // REGISTER
    // =====================================================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'regex:/^[a-zA-Z\s]+$/',
                'max:255'
            ],

            'email' => [
                'required',
                'email',
                'unique:students,email',
                'max:255'
            ],

            'password' => [
                'required',
                'string',
                'min:6',
                'confirmed'
            ],

            'phone' => [
                'required',
                'regex:/^\+?[0-9\s\-\(\)]{7,20}$/'
            ],

            'gender' => [
                'required',
                'string',
                'in:male,female,other'
            ],

            'course' => [
                'required',
                'string',
                'regex:/^[a-zA-Z\s]+$/',
                'max:255'
            ],

            'guardian_name' => [
                'required',
                'string',
                'regex:/^[a-zA-Z\s]+$/',
                'max:255'
            ],

            'guardian_phone' => [
                'required',
                'regex:/^\+?[0-9\s\-\(\)]{7,20}$/'
            ],

            'address' => [
                'required',
                'string',
                'max:500'
            ],

            'city' => [
                'required',
                'string',
                'regex:/^[a-zA-Z\s]+$/',
                'max:100'
            ],

            'country' => [
                'required',
                'string',
                'regex:/^[a-zA-Z\s]+$/',
                'max:100'
            ],

            'note' => [
                'nullable',
                'string',
                'max:1000'
            ],
        ], [

            'name.required' => 'Name is required',
            'name.regex' => 'Name must contain only letters',

            'email.required' => 'Email is required',
            'email.email' => 'Enter a valid email address',
            'email.unique' => 'This email is already registered',

            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 6 characters',
            'password.confirmed' => 'Passwords do not match',

            'phone.required' => 'Phone is required',
            'phone.regex' => 'Enter a valid phone number',

            'gender.required' => 'Please select gender',

            'course.required' => 'Course is required',

            'guardian_name.required' => 'Guardian name is required',
            'guardian_name.regex' => 'Guardian name must contain only letters',

            'guardian_phone.required' => 'Guardian phone is required',
            'guardian_phone.regex' => 'Enter a valid guardian phone number',

            'address.required' => 'Address is required',

            'city.required' => 'City is required',
            'city.regex' => 'City must contain only letters',

            'country.required' => 'Country is required',
            'country.regex' => 'Country must contain only letters',
        ]);


        // =====================================================
        // CLEAN PHONE NUMBERS
        // =====================================================

        $cleanPhone = preg_replace(
            '/[^0-9+]/',
            '',
            $validated['phone']
        );

        $cleanGuardianPhone = preg_replace(
            '/[^0-9+]/',
            '',
            $validated['guardian_phone']
        );


        // =====================================================
        // SAVE STUDENT
        // =====================================================

        DB::table('students')->insert([

            'name' => $validated['name'],

            'email' => $validated['email'],

            'password' => Hash::make(
                $validated['password']
            ),

            'phone' => $cleanPhone,

            'gender' => $validated['gender'],

            'course' => $validated['course'],

            'guardian_name' => $validated['guardian_name'],

            'guardian_phone' => $cleanGuardianPhone,

            'address' => $validated['address'],

            'city' => $validated['city'],

            'country' => $validated['country'],

            'note' => $validated['note'] ?? null,

            'created_at' => now(),

            'updated_at' => now(),
        ]);


        // Registration ke baad login page
        return redirect()
            ->route('login')
            ->with(
                'success',
                'Registration successful! Please login.'
            );
    }


    // =====================================================
    // LOGIN PAGE
    // =====================================================

    public function loginPage()
    {
        return view('login');
    }


    // =====================================================
    // LOGIN SUBMIT
    // =====================================================

    public function loginSubmit(Request $request)
    {
        // -------------------------------------------------
        // VALIDATION
        // -------------------------------------------------

        $request->validate([

            'email' => [
                'required',
                'email'
            ],

            'password' => [
                'required',
                'string'
            ],

        ], [

            'email.required' => 'Email is required',

            'email.email' => 'Enter a valid email address',

            'password.required' => 'Password is required',

        ]);


        // -------------------------------------------------
        // FIND STUDENT
        // -------------------------------------------------

        $student = DB::table('students')
            ->where('email', $request->email)
            ->first();


        // -------------------------------------------------
        // CHECK EMAIL + PASSWORD
        // -------------------------------------------------

        if (
            !$student ||
            !Hash::check(
                $request->password,
                $student->password
            )
        ) {

            return back()
                ->withErrors([
                    'email' => 'Email or password is incorrect.'
                ])
                ->withInput(
                    $request->only('email')
                );
        }


        // -------------------------------------------------
        // REGENERATE SESSION
        // -------------------------------------------------

        $request->session()->regenerate();


        // -------------------------------------------------
        // SAVE STUDENT SESSION
        // -------------------------------------------------

        $request->session()->put(
            'student_id',
            $student->id
        );

        $request->session()->put(
            'student_name',
            $student->name
        );

        $request->session()->put(
            'student_email',
            $student->email
        );


        // -------------------------------------------------
        // GET INTENDED URL
        // -------------------------------------------------
        //
        // PDF se login:
        //     PDF open hoga
        //
        // Books se login:
        //     Books page open hoga
        //
        // Direct login:
        //     Home page open hoga
        //

        $redirectUrl = $request->session()->pull(
            'intended_url'
        );


        // -------------------------------------------------
        // DEFAULT = HOME
        // -------------------------------------------------

        if (!$redirectUrl) {

            $redirectUrl = route('home');
        }


        // -------------------------------------------------
        // SECURITY CHECK
        // -------------------------------------------------
        //
        // Sirf apni website ke URLs allow karein.
        //

        $appUrl = rtrim(
            config('app.url'),
            '/'
        );

        if (
            !str_starts_with(
                $redirectUrl,
                $appUrl
            )
        ) {

            $redirectUrl = route('home');
        }


        // -------------------------------------------------
        // REDIRECT
        // -------------------------------------------------

        return redirect($redirectUrl)
            ->with(
                'success',
                'Welcome ' .
                $student->name .
                '! Login successful.'
            );
    }


    // =====================================================
    // LOGOUT
    // =====================================================

    public function logout()
    {
        // Clear student session
        Session::forget([
            'student_id',
            'student_name',
            'student_email',
            'intended_url'
        ]);


        return redirect()
            ->route('login')
            ->with(
                'success',
                'Logged out successfully.'
            );
    }
}

