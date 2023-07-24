<?php

namespace App\Services\Impl;

use App\Repositories\Impl\CourseAccountRepository;
use App\Repositories\Impl\CourseRepository;
use App\Services\CourseService;
use App\Utils\MessageCommon;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AccountSettingServiceImpl
 *
 * @package App\Services\Impl
 *
 * @property CourseRepository $accountRepository
 */
class CourseServiceImpl extends BaseServiceImpl implements CourseService
{
    /**
     * CourseServiceImpl constructor.
     * @param CourseRepository $accountRepository
     */
    public function __construct(
        CourseRepository $courseRepository,
        public CourseAccountRepository $courseAccountRepository,
    ) {
        parent::__construct($courseRepository);
    }


    public function update($id, array $data): Model
    {
        try {
            $courseData = [
                'name' => $data['name'],
                'descriptions' => $data['descriptions'],
            ];
            $courseData = $this->repository->update($id, $courseData);

            foreach ($data['course_accounts'] as $courseAccount) {
                $courseAccountData[] = [
                    'course_id' => $id,
                    'account_id' => $courseAccount['id'],
                    'start_date' => Carbon::now(),
                    'end_date' => '2023-07-12',
                ];
            }
            $this->courseAccountRepository->createMultiple($courseAccountData);
            return $courseData;
        } catch (Exception $e) {
            throw new Exception(MessageCommon::MS01_002);
        }
    }
}
