<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\BaseController;
use App\Services\CourseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\CourseRequest;

class CourseController extends BaseController
{
    /**
     * AccountSettingController constructor.
     *
     * @param CourseService $service
     * @param Request $request
     */
    public function __construct(CourseService $service, Request $request)
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
        return CourseRequest::class;
    }
}
