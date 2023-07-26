<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Question extends BaseModel
{
    use HasFactory;

    protected $table = 'questions';

    protected $fillable = [
        'content',
        'topic_id',
        'description',
    ];

    public function topics()
    {
        return $this->belongsTo(Topic::class, 'topic_id', 'id');
    }

    // Scopes
    public function scopeCourseId(Builder $query, $courseId): Builder
    {
        return $query->whereHas('topics', function (Builder $query) use ($courseId) {
            $query->where('course_id', $courseId);
        });
    }

    public function scopeTopicId(Builder $query, $topicId): Builder
    {
        return $query->where('topic_id', $topicId);
    }
}
