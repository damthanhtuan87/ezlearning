<?php

namespace App\Repositories\Impl;

use App\Models\Account;
use App\Models\CourseAccount;
use App\Repositories\CourseAccountRepositoryInterface;
use Illuminate\Support\Facades\DB;

/**
 * Class CourseAccountRepository
 *
 * @package App\Repositories\Impl
 *
 * @property Account $model
 */
class CourseAccountRepository extends BaseRepository implements CourseAccountRepositoryInterface
{
    /**
     * AdminRepository constructor.
     *
     * @param Account $model
     */
    public function __construct(CourseAccount $model)
    {
        parent::__construct($model);
    }

    /**
     * Create many record
     *
     * @param $arrayData
     * @return bool
     */
    public function createMultiple($arrayData)
    {
        return DB::table('course_account')->insert($arrayData);
    }
}
