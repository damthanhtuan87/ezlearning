<?php

namespace App\Models;

use App\Models\Traits\LogActions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class CourseAccount extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, LogActions;

    public const DEFAULT_ORDER_SCOPE = 'defaultOrder';

    protected string $orderByColumn = 'id';

    protected string $orderByDirection = 'desc';

    protected $table = 'course_account';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'course_id',
        'account_id',
        'start_date',
        'end_date',
    ];

}
