<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\BaseController;
use App\Services\TopicService;
use Illuminate\Http\Request;

class TopicController extends BaseController
{
    /**
     * TopicController constructor.
     *
     * @param \App\Services\TopicService $service
     * @param Request $request
     */
    public function __construct(TopicService $service, Request $request)
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
