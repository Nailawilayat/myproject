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


    /*
    |--------------------------------------------------------------------------
    | LIVE CLASSES
    |--------------------------------------------------------------------------
    */

    public function liveClasses()
    {
        $teacherName = session('student_name');

        $classes = DB::table('live_classes')
            ->where('teacher_name', $teacherName)
            ->orderBy('scheduled_at', 'desc')
            ->get();

        return view('teacher.live-classes', compact('classes'));
    }


    public function createLiveClass()
    {
        $courses = $this->getMyCourses();

        return view('teacher.live-classes-create', compact('courses'));
    }


    public function storeLiveClass(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'platform' => 'required|string|max:50',
            'meeting_link' => 'required|url',
            'scheduled_at' => 'required|date',
            'duration_minutes' => 'required|integer|min:15',
        ]);

        DB::table('live_classes')->insert([
            'course_id' => $validated['course_id'],
            'teacher_name' => session('student_name'),
            'title' => $validated['title'],
            'platform' => $validated['platform'],
            'meeting_link' => $validated['meeting_link'],
            'scheduled_at' => $validated['scheduled_at'],
            'duration_minutes' => $validated['duration_minutes'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()
            ->route('teacher.live-classes')
            ->with('success', 'Live class scheduled successfully.');
    }


    public function deleteLiveClass($id)
    {
        DB::table('live_classes')->where('id', $id)->delete();

        return back()->with('success', 'Live class removed.');
    }
}