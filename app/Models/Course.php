<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'short_title',
        'image',
        'overview',
        'teacher',
        'teacher_designation',
        'teacher_bio',
        'teacher_image',
        'category',
        'duration',
        'featured',
    ];

    protected $casts = [
        'benefits' => 'array',
    ];

     public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('order_no');
    }

public function curriculum()
{
    return $this->hasMany(Curriculum::class);
}
public function reviews()
{
    return $this->hasMany(Review::class);
}
}
/*
    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}

 */