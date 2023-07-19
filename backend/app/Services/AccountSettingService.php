<?php

namespace App\Services;

use App\Http\Parameters\Criteria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;

interface AccountSettingService extends BaseService
{
    /**
     * Create new model
     *
     * @param $data
     * @return mixed
     */
    public function create(array $data): Model;

    /**
     * Get list model items by pagination
     *
     * @param Criteria $criteria
     * @param $selectedProductList
     * @return LengthAwarePaginator
     */
    public function getListSettedUserModal(Criteria $criteria, $selectedProductList): ?LengthAwarePaginator;
}
