<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
{
    \App\Models\Review::create([
        'course_id' => 1,
        'name'      => 'Sara Ahmed',
        'rating'    => 4,
        'comment'   => 'Good',
    ]);

    \App\Models\Review::create([
        'course_id' => 1,
        'name'      => 'Bilal Hussain',
        'rating'    => 5,
        'comment'   => 'Excellent teaching style, highly recommended.',
    ]);
}
}