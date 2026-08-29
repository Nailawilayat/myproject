<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CourseFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence(3);

        return [

            'title' => $title,

            'slug' => Str::slug($title),

            'short_description' =>
            fake()->paragraph(),

            'full_description' =>
            fake()->paragraph(5),

            'teacher_name' =>
            fake()->name(),

            'category' =>
            'Quran Course',

            'duration' =>
            '60 Hours',

            'skill_level' =>
            'Beginner',

            'language' =>
            'English',

            'students' =>
            rand(10, 100),

            'lectures' =>
            rand(1, 20),

            'quizzes' =>
            rand(1, 5),

            'assessments' =>
            'Yes',

            'image' =>
            'courses/demo.jpg',

            'rating' =>
            5,

            'status' =>
            'active'
        ];
    }
}