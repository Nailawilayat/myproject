<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    protected $table = 'curriculums'; // explicitly set actual table name

    protected $fillable = [
        'course_id',
        'title',
        'pdf_file'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}