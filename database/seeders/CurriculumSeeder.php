<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Curriculum;

class CurriculumSeeder extends Seeder
{
    public function run(): void
    {
        $courses = Course::all();

        if ($courses->isEmpty()) {
            $this->command->error('No courses found in database.');
            return;
        }

       $courseCurriculums = [

    'Quran Reading Course' => [
        ['title' => 'Quran Reading PDF', 'pdf_file' => 'quran.pdf'],
    ],

    'Beginner Quran Course' => [
        ['title' => 'Beginner Quran PDF', 'pdf_file' => 'Noorani-qaida.pdf'],
    ],

    'Learn Tajweed Online' => [
        ['title' => 'Tajweed Rules PDF', 'pdf_file' => 'tajweed-rules.pdf'],
    ],

    'Tarjuma-tul-Quran Course' => [
        ['title' => 'Tarjuma PDF', 'pdf_file' => 'tarjuma-quran.pdf'],
    ],

    'Reading the Holy Quran - Juz 30' => [
        ['title' => 'Juz 30 PDF', 'pdf_file' => 'juzz-30.pdf'],
    ],

    'Learn Basic Islamic Education' => [
        ['title' => 'Basic Islamic Education PDF', 'pdf_file' => 'basic-duas.pdf'],
    ],
];

        foreach ($courses as $course) {

            $items = $courseCurriculums[$course->title] ?? [];

            if (empty($items)) {
                $this->command->warn("No curriculum defined for course: {$course->title}");
                continue;
            }

            foreach ($items as $curriculum) {
                Curriculum::firstOrCreate(
                    [
                        'course_id' => $course->id,
                        'title'     => $curriculum['title'],
                    ],
                    [
                        'pdf_file'  => $curriculum['pdf_file'],
                    ]
                );
            }

            $this->command->info("Curriculum seeded for course: {$course->title}");
        }

        $this->command->info('All courses curriculum seeded successfully!');
    }
}