<?php

namespace App\Services\Impl;

use App\Repositories\Impl\QuestionRepository;
use App\Services\QuestionService;

/**
 * Class QuestionServiceImpl 
 *
 * @package App\Services\Impl
 *
 * @property QuestionRepository $questionRepository
 */
class QuestionServiceImpl extends BaseServiceImpl implements QuestionService
{
    /**
     * QuestionServiceImpl constructor.
     * @param QuestionRepository $questionRepository
     */
    public function __construct(QuestionRepository $questionRepository)
    {
        parent::__construct($questionRepository);
    }
}
