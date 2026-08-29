<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'course_id',
        'name',
        'rating',
        'comment',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}