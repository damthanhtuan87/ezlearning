<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends BaseModel
{
    use HasFactory;

    protected $table = 'answers';

    protected $fillable = [
        'content',
        'question_id',
        'is_correct',
    ];
}
