<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    protected $fillable = [
    'plan_name',
    'days_per_week',
    'free_trial_days',
    'minutes_per_day',
    'age_gender',
    'support',
    'class_type',
    'sort_order',
];
}