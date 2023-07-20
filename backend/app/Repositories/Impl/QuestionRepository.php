<?php

namespace App\Repositories\Impl;

use App\Models\Question;
use App\Repositories\QuestionRepositoryInterface;

/**
 * Class AdminRepository
 *
 * @package App\Repositories\Impl
 *
 * @property Question $model
 */
class QuestionRepository extends BaseRepository implements QuestionRepositoryInterface
{
    /**
     * QuestionRepository constructor.
     *
     * @param Question $model
     */
    public function __construct(Question $model)
    {
        parent::__construct($model);
    }
}
