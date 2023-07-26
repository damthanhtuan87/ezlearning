<?php

namespace App\Services\Impl;

use App\Repositories\Impl\TopicRepository;
use App\Services\TopicService;

/**
 * Class TopicServiceImpl 
 *
 * @package App\Services\Impl
 *
 * @property TopicRepository $topicRepository
 */
class TopicServiceImpl extends BaseServiceImpl implements TopicService
{
    /**
     * TopicServiceImpl constructor.
     * @param TopicRepository $topicRepository
     */
    public function __construct(TopicRepository $topicRepository)
    {
        parent::__construct($topicRepository);
    }
}
