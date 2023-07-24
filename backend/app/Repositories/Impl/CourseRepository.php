<?php

namespace App\Repositories\Impl;

use App\Http\Parameters\Criteria;
use App\Models\Course;
use App\Repositories\CourseRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class AdminRepository
 *
 * @package App\Repositories\Impl
 *
 * @property Course $model
 */
class CourseRepository extends BaseRepository implements CourseRepositoryInterface
{
    /**
     * AdminRepository constructor.
     *
     * @param Course $model
     */
    public function __construct(Course $model)
    {
        parent::__construct($model);
    }

    /**
     * Get list model Cf Transactions with pagination
     *
     * @param Criteria $criteria
     *
     * @return LengthAwarePaginator
     */
    public function list(Criteria $criteria): LengthAwarePaginator
    {
        $criteria->setRelations([
            'courseAccounts'
        ]);
        $criteria->setSelect([
            'courses.id',
            'courses.name',
            'courses.descriptions',
            'courses.created_at',
            'courses.updated_at',
            DB::raw("count(course_account.id) as total_quantity"),
        ]);
        $query = $this->newQuery()->scopes($this->loadScopes($criteria->getFilters()));
        $query->select($criteria->getSelect())
            ->leftJoin('course_account', 'course_account.course_id', '=', 'courses.id')
            ->whereNull('course_account.deleted_at')
            ->groupBy([
                'courses.id',
                'courses.name',
                'courses.descriptions',
                'courses.created_at',
                'courses.updated_at',
            ]);

        return $this->applyOrderBy($query, $criteria->getSorts())
            ->with($this->getRelations($criteria))
            ->withCount($this->getCountRelations($criteria))
            ->paginate($criteria->getLimit(), ['*'], config('pagination.page_name'), $criteria->getPage());
    }

    /**
     * Find model by id
     *
     * @param int|string $id
     *
     * @return Model|Collection
     */
    public function find($id): object
    {
        $dataModel = parent::find($id);
        $courseAccountData = $dataModel->courseAccounts;
        foreach ($courseAccountData as $courseAccount) {
            $account = $courseAccount->account;
            $courseAccount->name = $account->name;
            $courseAccount->email = $account->email;
        }
        return $dataModel;
    }
}
