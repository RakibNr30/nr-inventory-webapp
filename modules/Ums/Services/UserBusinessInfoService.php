<?php

namespace Modules\Ums\Services;

use Modules\Ums\Repositories\UserBusinessInfoRepository;

class UserBusinessInfoService
{
    /**
     * @var $userBusinessInfoRepository
     */
    protected $userBusinessInfoRepository;

    /**
     * Constructor
     *
     * @param UserBusinessInfoRepository $userBusinessInfoRepository
     */
    public function __construct(UserBusinessInfoRepository $userBusinessInfoRepository)
    {
        $this->userBusinessInfoRepository = $userBusinessInfoRepository;
    }

    /**
     * Get all data
     *
     * @param int $limit
     * @return mixed
     */
    public function all($limit = 0)
    {
        return $this->userBusinessInfoRepository->paginate($limit);
    }

    /**
     * Get all data
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->userBusinessInfoRepository->create($data);
    }

    /**
     * Find data
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->userBusinessInfoRepository->find($id);
    }

    /**
     * Update data
     *
     * @param $data
     * @param $id
     * @return mixed
     */
    public function update($data, $id)
    {
        return $this->userBusinessInfoRepository->update($data, $id);
    }

    /**
     * Delete data
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->userBusinessInfoRepository->delete($id);
    }

    /**
     * First or create data
     *
     * @param $data
     * @return mixed
     */
    public function firstOrCreate($data)
    {
        return $this->userBusinessInfoRepository->model->firstOrCreate($data);
    }

    /**
     * Update or create additional info
     *
     * @param $attribute
     * @param $value
     * @return mixed
     */
    public function updateOrCreate($attribute, $value)
    {
        return $this->userBusinessInfoRepository->model->updateOrCreate($attribute, $value);
    }
}
