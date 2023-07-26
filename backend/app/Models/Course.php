<?php

namespace App\Models;

use App\Models\Traits\LogActions;
use Helper\Common;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class Course extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, LogActions;

    public const DEFAULT_ORDER_SCOPE = 'defaultOrder';

    protected string $orderByColumn = 'id';

    protected string $orderByDirection = 'desc';

    protected $table = 'courses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
    ];

    protected static function booting()
    {
        static::addGlobalScope(
            self::DEFAULT_ORDER_SCOPE,
            function (Builder $builder) {
                $builder->scopes('defaultOrderBy');
            }
        );
    }

    // Relations
    public function courseAccounts() {
        return $this->hasMany(CourseAccount::class, 'course_id', 'id');
    }

    public function questions() {
        return $this->hasManyThrough(
            Question::class,
            Topic::class,
            'course_id',
            'topic_id',
            'id',
            'id'
        );
    }

    /**
     * Scope search by course id.
     * 
     * @param $courseId $query
     */
    public function scopeCourseId(Builder $query, $courseId): Builder
    {
        return $query->where('courses.id', $courseId);
    }

     /**
     * Scope search by course name.
     *
     * @param $courseName $query
     */
    public function scopeCourseName(Builder $query, $courseName): Builder
    {
        return $query->where('name', 'like', '%' . Common::escapeWildcard($courseName) . '%');
    }

     /**
     * Scope a query to set a default order.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeDefaultOrderBy(Builder $query): Builder
    {
        if (!$this->timestamps) {
            return $query;
        }

        return $query->orderBy($this->getTable() . '.' . $this->orderByColumn, $this->orderByDirection);
    }
}
