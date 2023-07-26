<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $table = 'topics';

    protected $fillable = [
        'name',
        'course_id',
        'description',
        'time_practice',
    ];

    // Relations
    public function courses()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function scopeCourseId($query, $course_id)
    {
        return $query->where('course_id', $course_id);
    }
}
