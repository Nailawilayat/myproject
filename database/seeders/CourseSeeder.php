<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('courses')->insert([

            // 1. Beginner Course
            [
                'title'               => 'Beginner Quran Course',
                'slug'                => 'beginner',
                'short_title'         => 'Beginner',
                'image'               => 'images/beginner.jpg',
                'overview'            => 'This course is designed for absolute beginners who want to start their journey of learning the Holy Quran from scratch. Students will learn Arabic alphabets, basic pronunciation, and simple reading techniques in a friendly and supportive environment.',
                'teacher'             => ' ',
                'teacher_designation' => 'Senior Quran Teacher',
                'teacher_bio'         => '',
                'teacher_image'       => 'teachers/user1.jpg',
                'category'            => 'Quran Studies',
                'duration'            => '4 Weeks',
                'level'               => 'Beginner',
                'language'            => 'English, Urdu',
                'students'            => 120,
                'lectures'            => 20,
                'quizzes'             => 5,
                'featured'            => 1,
                'created_at'          => Carbon::now(),
                'updated_at'          => Carbon::now(),
            ],

            // 2. Quran Reading Course
            [
                'title'               => 'Quran Reading Course',
                'slug'                => 'quran-reading-course',
                'short_title'         => 'Reading Quran',
                'image'               => 'images/quran-reading.jpg',
                'overview'            => 'The Quran Reading Course is designed to help students learn how to read the Holy Quran correctly and fluently with proper pronunciation, Makharij, and basic Tajweed rules under expert guidance.',
                'teacher'             => ' ',
                'teacher_designation' => 'Quran Reading Specialist',
                'teacher_bio'         => '',
                'teacher_image'       => 'teachers/user1.jpg',
                'category'            => 'Quran Studies',
                'duration'            => '6 Weeks',
                'level'               => 'Beginner to Intermediate',
                'language'            => 'English, Urdu, Arabic',
                'students'            => 280,
                'lectures'            => 30,
                'quizzes'             => 8,
                'featured'            => 1,
                'created_at'          => Carbon::now(),
                'updated_at'          => Carbon::now(),
            ],

            // 3. Tajweed Course
            [
                'title'               => 'Learn Tajweed Online',
                'slug'                => 'tajweed',
                'short_title'         => 'Tajweed',
                'image'               => 'images/qurann.jpg',
                'overview'            => 'Learn the rules of Tajweed to recite the Holy Quran with correct pronunciation and proper articulation points (Makharij). This course covers all essential Tajweed rules in a structured and easy-to-understand manner.',
                'teacher'             => 'Qari Muhammad Yusuf',
                'teacher_designation' => 'Certified Tajweed Expert',
                'teacher_bio'         => '',
                'teacher_image'       => 'teachers/user4.jpg',
                'category'            => 'Tajweed',
                'duration'            => '8 Weeks',
                'level'               => 'Intermediate',
                'language'            => 'English, Urdu',
                'students'            => 273,
                'lectures'            => 35,
                'quizzes'             => 10,
                'featured'            => 1,
                'created_at'          => Carbon::now(),
                'updated_at'          => Carbon::now(),
            ],

            // 4. Tarjuma Quran Course
            [
                'title'               => 'Tarjuma-tul-Quran Course',
                'slug'                => 'tarjuma',
                'short_title'         => 'Tarjuma Quran',
                'image'               => 'images/quran1.jpg',
                'overview'            => 'This course helps students understand the meanings and translation (Tarjuma) of the Holy Quran. Students will gain deep insight into Quranic verses, their context, and practical lessons for daily life.',
                'teacher'             => '',
                'teacher_designation' => 'Islamic Scholar & Quran Translator',
                'teacher_bio'         => '',
                'teacher_image'       => 'teachers/user1.jpg',
                'category'            => 'Quran Translation',
                'duration'            => '10 Weeks',
                'level'               => 'Intermediate to Advanced',
                'language'            => 'English, Urdu',
                'students'            => 95,
                'lectures'            => 40,
                'quizzes'             => 12,
                'featured'            => 0,
                'created_at'          => Carbon::now(),
                'updated_at'          => Carbon::now(),
            ],

            // 5. Reading Quran Juz 30 Course
            [
                'title'               => 'Reading the Holy Quran - Juz 30',
                'slug'                => 'juz30',
                'short_title'         => 'Juz 30',
                'image'               => 'images/juz30.jpg',
                'overview'            => 'This course focuses on reading and memorizing Juz Amma (the 30th part of the Quran), which contains short and frequently recited Surahs. Ideal for beginners and children to build confidence in Quran recitation.',
                'teacher'             => '',
                'teacher_designation' => 'Quran Memorization Teacher',
                'teacher_bio'         => '',
                'teacher_image'       => 'teachers/user2.jpg',
                'category'            => 'Quran Memorization',
                'duration'            => '5 Weeks',
                'level'               => 'Beginner',
                'language'            => 'English, Urdu',
                'students'            => 150,
                'lectures'            => 25,
                'quizzes'             => 6,
                'featured'            => 1,
                'created_at'          => Carbon::now(),
                'updated_at'          => Carbon::now(),
            ],

            // 6. Basic Islamic Education Course
            [
                'title'               => 'Learn Basic Islamic Education',
                'slug'                => 'basic_islamic',
                'short_title'         => 'Islamic Education',
                'image'               => 'images/islamic-education.jpg',
                'overview'            => 'This course covers the fundamental teachings of Islam including beliefs (Aqeedah), worship (Ibadah), manners (Akhlaq), and essential knowledge every Muslim should have. Perfect for new Muslims and beginners.',
                'teacher'             => ' ',
                'teacher_designation' => 'Islamic Studies Teacher',
                'teacher_bio'         => '',
                'teacher_image'       => 'teachers/user1.jpg',
                'category'            => 'Islamic Studies',
                'duration'            => '6 Weeks',
                'level'               => 'Beginner',
                'language'            => 'English, Urdu',
                'students'            => 1,
                'lectures'            => 22,
                'quizzes'             => 7,
                'featured'            => 0,
                'created_at'          => Carbon::now(),
                'updated_at'          => Carbon::now(),
            ],

        ]);
    }
}