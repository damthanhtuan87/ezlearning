<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\BaseController;
use App\Services\QuestionService;
use Illuminate\Http\Request;

class QuestionController extends BaseController
{
    /**
     * QuestionController constructor.
     *
     * @param QuestionService $service
     * @param Request $request
     */
    public function __construct(QuestionService $service, Request $request)
    {
        parent::__construct($service, $request);
    }

    /**
     * Get FormRequest validation
     *
     * @return string
     */
    public function getRules(): string
    {
        return Request::class;
    }
}