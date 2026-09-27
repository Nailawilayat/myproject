<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

        return view('students.dashboard', [
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

        return view('students.course', [
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
            'students.books',
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
        $student = DB::table('students')
            ->where('id', session('student_id'))
            ->first();

        $courseName = $student->course ?? null;

        $classes = collect();

        if ($courseName) {

            $searchTerm = strtolower(trim($courseName));

            $classes = DB::table('live_classes')
                ->join('courses', 'live_classes.course_id', '=', 'courses.id')
                ->whereRaw('LOWER(courses.title) LIKE ?', ['%' . $searchTerm . '%'])
                ->select('live_classes.*', 'courses.title as course_title')
                ->orderBy('scheduled_at', 'asc')
                ->get()
                ->map(function ($class) {
                    $class->status = $this->getClassStatus($class->scheduled_at, $class->duration_minutes);
                    // backward compatibility, in case any old blade still checks is_live
                    $class->is_live = $class->status === 'live';
                    return $class;
                })
                // "Upcoming Live Classes" page se time-over ho chuki classes hata do
                ->reject(function ($class) {
                    return $class->status === 'time_over';
                })
                ->values();
        }

        return view('students.live-classes', compact('classes'));
    }


    /*
    |--------------------------------------------------------------------------
    | HELPER: Determine class status -> upcoming | live | time_over
    |--------------------------------------------------------------------------
    */
    private function getClassStatus($scheduledAt, $durationMinutes)
    {
        $start = Carbon::parse($scheduledAt);
        $end = $start->copy()->addMinutes($durationMinutes);
        $now = Carbon::now();

        if ($now->lt($start)) {
            return 'upcoming';
        }

        if ($now->between($start, $end)) {
            return 'live';
        }

        return 'time_over';
    }
}