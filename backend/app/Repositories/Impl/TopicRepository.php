<?php

namespace App\Repositories\Impl;

use App\Models\Topic;
use App\Repositories\TopicRepositoryInterface;

/**
 * Class AdminRepository
 *
 * @package App\Repositories\Impl
 *
 * @property Topic $model
 */
class TopicRepository extends BaseRepository implements TopicRepositoryInterface
{
    /**
     * TopicRepository constructor.
     *
     * @param Topic $model
     */
    public function __construct(Topic $model)
    {
        parent::__construct($model);
    }
}
