<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Review;
use App\Models\Application;
use App\Models\Curriculum;

class CourseController extends Controller
{
    /**
     * COURSES LIST PAGE
     */
    public function index()
    {
        $courses = Course::where('status', 1)->get();

        return view('courses.index', compact('courses'));
    }

    /**
     * SINGLE COURSE PAGE
     */
  public function show($slug)
{
    $course = Course::with(['curriculum', 'reviews'])
        ->where('slug', $slug)
        ->firstOrFail();

    $popularCourses = Course::where('id', '!=', $course->id)
        ->where('status', 1)
        ->with('reviews')
        ->latest()
        ->take(3)
        ->get();

    $relatedCourses = Course::where('id', '!=', $course->id)
        ->where('status', 1)
        ->with('reviews')
        ->latest()
        ->take(3)
        ->get();

    // Agar us course ka custom design page exist karta hai, wahi use karo
    $customView = 'courses.' . $slug;

    if (view()->exists($customView)) {
        return view($customView, compact(
            'course',
            'popularCourses',
            'relatedCourses'
        ));
    }

    // Warna generic template use karo (naye admin-added courses ke liye)
    return view('courses.show', compact(
        'course',
        'popularCourses',
        'relatedCourses'
    ));
}
    /**
     * COURSE APPLICATION
     */
    public function apply(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'name'      => 'required',
            'email'     => 'required|email',
        ]);

        Application::create([
            'course_id' => $request->course_id,
            'name'      => $request->name,
            'email'     => $request->email,
        ]);

        return back()->with('success', 'Application submitted successfully!');
    }

    /**
     * REVIEW STORE
     */
    public function review(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'name'      => 'required',
            'rating'    => 'required|integer|min:1|max:5',
            'comment'   => 'required|string|max:1000',
        ]);

        Review::create([
            'course_id' => $request->course_id,
            'name'      => $request->name,
            'rating'    => $request->rating,
            'comment'   => $request->comment,
        ]);

        return back()->with('success', 'Review submitted successfully!');
    }

    public function viewPdf($id)
    {
        $curriculum = Curriculum::findOrFail($id);

        $file = public_path('pdfs/' . $curriculum->pdf_file);

        if (!file_exists($file)) {
            abort(404, 'PDF not found.');
        }

        return response()->file($file);
    }
}