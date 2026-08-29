<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pricing;

class PricingSeeder extends Seeder
{
    public function run(): void
    {
        Pricing::truncate();

        Pricing::insert([

            [
                'plan_name' => 'PLAN A',
                'days_per_week' => 2,
                'days_per_week_text' => '2-3 Days/week',
                'free_trial_days' => 2,
                'minutes_per_day' => 40,
                'age_gender' => 'Any age and any gender',
                'support' => '24/7 Phone, Chat & Email',
                'class_type' => 'One by one classes',
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'plan_name' => 'PLAN B',
                'days_per_week' => 4,
                'days_per_week_text' => '4 Days/week',
                'free_trial_days' => 2,
                'minutes_per_day' => 40,
                'age_gender' => 'Any age and any gender',
                'support' => '24/7 Phone, Chat & Email',
                'class_type' => 'One by one classes',
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'plan_name' => 'PLAN C',
                'days_per_week' => 5,
                'days_per_week_text' => '5 Days/week',
                'free_trial_days' => 2,
                'minutes_per_day' => 40,
                'age_gender' => 'Any age and any gender',
                'support' => '24/7 Phone, Chat & Email',
                'class_type' => 'One by one classes',
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'plan_name' => 'PLAN D',
                'days_per_week' => 6,
                'days_per_week_text' => '6 Days/week',
                'free_trial_days' => 2,
                'minutes_per_day' => 40,
                'age_gender' => 'Any age and any gender',
                'support' => '24/7 Phone, Chat & Email',
                'class_type' => 'One by one classes',
                'sort_order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}