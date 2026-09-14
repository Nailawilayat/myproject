<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HELPER: Get logged-in teacher's matched courses
    |--------------------------------------------------------------------------
    */

    private function getMyCourses()
    {
        $teacherName = strtolower(trim(session('student_name', '')));

        return DB::table('courses')
            ->get()
            ->filter(function ($course) use ($teacherName) {
                return strtolower(trim($course->teacher ?? '')) === $teacherName;
            })
            ->values();
    }


    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    public function dashboard()
    {
        $courses = $this->getMyCourses();

        $coursesCount = $courses->count();

        $courseTitles = $courses->pluck('title')->toArray();

        $studentsCount = DB::table('students')
            ->whereIn('course', $courseTitles)
            ->count();

        $lecturesCount = $courses->sum('lectures');

        $quizzesCount = $courses->sum('quizzes');

        return view('teacher.dashboard', [
            'teacherName' => session('student_name'),
            'coursesCount' => $coursesCount,
            'studentsCount' => $studentsCount,
            'lecturesCount' => $lecturesCount,
            'quizzesCount' => $quizzesCount,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | MY COURSES
    |--------------------------------------------------------------------------
    */

    public function myCourses()
    {
        $courses = $this->getMyCourses();

        return view(
            'teacher.courses',
            compact('courses')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | MY STUDENTS
    |--------------------------------------------------------------------------
    */

    public function myStudents()
    {
        $courses = $this->getMyCourses();

        $courseTitles = $courses->pluck('title')->toArray();

        $students = DB::table('students')
            ->whereIn('course', $courseTitles)
            ->latest()
            ->get();

        return view(
            'teacher.students',
            compact('students')
        );
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
            'teacher.books',
            compact('books')
        );
    }
}