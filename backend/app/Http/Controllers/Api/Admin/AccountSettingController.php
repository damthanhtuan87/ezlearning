<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\BaseController;
use App\Http\Parameters\Criteria;
use App\Http\Requests\AccountRequest;
use App\Services\AccountSettingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class AccountSettingController extends BaseController
{
    /**
     * AccountSettingController constructor.
     *
     * @param AccountSettingService $service
     * @param Request $request
     */
    public function __construct(AccountSettingService $service, Request $request)
    {
        parent::__construct($service, $request);
    }

      /**
     * Get list productSetted
     *
     * @return JsonResponse
     */
    public function getListSettedUserModal(): JsonResponse
    {
        $selectedUserList = [];
        return $this->success(
            $this->service->getListSettedUserModal(Criteria::createFromRequest($this->request), $selectedUserList),
            Response::HTTP_OK
        );
    }

    /**
     * Get FormRequest validation
     *
     * @return string
     */
    public function getRules(): string
    {
        return AccountRequest::class;
    }

}
