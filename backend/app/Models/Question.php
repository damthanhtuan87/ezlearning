<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends BaseModel
{
    use HasFactory;

    protected $table = 'questions';

    protected $fillable = [
        'content',
        'topic_id',
        'description',
    ];
}
