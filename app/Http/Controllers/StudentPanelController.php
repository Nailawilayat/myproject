<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentPanelController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HELPER: Try to find matching course details (extra info only)
    |--------------------------------------------------------------------------
    */

    private function findMatchingCourse($studentCourseText)
    {
        if (empty($studentCourseText)) {
            return null;
        }

        $searchTerm = strtolower(trim($studentCourseText));

        $course = DB::table('courses')
            ->whereRaw('LOWER(TRIM(title)) = ?', [$searchTerm])
            ->first();

        if ($course) {
            return $course;
        }

        $course = DB::table('courses')
            ->whereRaw('LOWER(title) LIKE ?', ['%' . $searchTerm . '%'])
            ->first();

        return $course;
    }


    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    public function dashboard()
    {
        $student = DB::table('students')
            ->where('id', session('student_id'))
            ->first();

        $courseName = $student->course ?? null;

        $matchedCourse = $this->findMatchingCourse($courseName);

        $booksCount = DB::table('books')->count();

        return view('student.dashboard', [
            'studentName' => session('student_name'),
            'student' => $student,
            'courseName' => $courseName,
            'matchedCourse' => $matchedCourse,
            'booksCount' => $booksCount,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | MY COURSE
    |--------------------------------------------------------------------------
    */

    public function myCourse()
    {
        $student = DB::table('students')
            ->where('id', session('student_id'))
            ->first();

        $courseName = $student->course ?? null;

        $matchedCourse = $this->findMatchingCourse($courseName);

        return view('student.course', [
            'courseName' => $courseName,
            'matchedCourse' => $matchedCourse,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | BOOKS
    |--------------------------------------------------------------------------
    */

    public function books()
    {
        $books = DB::table('books')
            ->latest()
            ->get();

        return view(
            'student.books',
            compact('books')
        );
    }
}