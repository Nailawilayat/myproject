<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCourseController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->get();

        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'title' => 'required',
            'short_description' => 'required',
            'full_description' => 'required',
            'teacher_name' => 'required',
            'category' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png'
        ]);

        // Image Upload
        $imageName = null;

        if ($request->hasFile('image')) {

            $imageName = $request->file('image')
                        ->store('courses', 'public');
        }

        // Create Course
        $course = Course::create([

            'title' => $request->title,

            'slug' => Str::slug($request->title),

            'short_description' => $request->short_description,

            'full_description' => $request->full_description,

            'teacher_name' => $request->teacher_name,

            'category' => $request->category,

            'duration' => $request->duration,

            'skill_level' => $request->skill_level,

            'language' => $request->language,

            'students' => $request->students,

            'lectures' => $request->lectures,

            'quizzes' => $request->quizzes,

            'assessments' => $request->assessments,

            'rating' => $request->rating,

            'status' => $request->status,

            'image' => $imageName,
        ]);

        // Save Lessons
        if ($request->lesson_title) {

            foreach ($request->lesson_title as $key => $lesson) {

                Lesson::create([

                    'course_id' => $course->id,

                    'lesson_title' => $lesson,

                    'lesson_duration' =>
                    $request->lesson_duration[$key]
                ]);
            }
        }

        // Redirect to Dynamic Course Page
        return redirect()->route('course.show', $course->slug);
    }

    public function edit($id)
    {
        $course = Course::with('lessons')->findOrFail($id);

        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $request->validate([
            'title' => 'required'
        ]);

        // Update Image
        if ($request->hasFile('image')) {

            $imageName = $request->file('image')
                        ->store('courses', 'public');

            $course->image = $imageName;
        }

        $course->update([

            'title' => $request->title,

            'slug' => Str::slug($request->title),

            'short_description' => $request->short_description,

            'full_description' => $request->full_description,

            'teacher_name' => $request->teacher_name,

            'category' => $request->category,

            'duration' => $request->duration,

            'skill_level' => $request->skill_level,

            'language' => $request->language,

            'students' => $request->students,

            'lectures' => $request->lectures,

            'quizzes' => $request->quizzes,

            'assessments' => $request->assessments,

            'rating' => $request->rating,

            'status' => $request->status,
        ]);

        // Delete old lessons
        $course->lessons()->delete();

        // Reinsert lessons
        if ($request->lesson_title) {

            foreach ($request->lesson_title as $key => $lesson) {

                Lesson::create([

                    'course_id' => $course->id,

                    'lesson_title' => $lesson,

                    'lesson_duration' =>
                    $request->lesson_duration[$key]
                ]);
            }
        }

        return redirect()->route('admin.courses.index');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);

        $course->delete();

        return back();
    }
}