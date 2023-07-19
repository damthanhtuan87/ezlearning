<?php

namespace App\Services\Impl;

use App\Http\Parameters\Criteria;
use App\Repositories\Impl\CourseRepository;
use App\Services\CourseService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


/**
 * Class AccountSettingServiceImpl
 *
 * @package App\Services\Impl
 *
 * @property CourseRepository $accountRepository
 */
class CourseServiceImpl extends BaseServiceImpl implements CourseService
{
    /**
     * AccountSettingServiceImpl constructor.
     * @param CourseRepository $accountRepository
     */
    public function __construct(CourseRepository $courseRepository)
    {
        parent::__construct($courseRepository);
    }

}
