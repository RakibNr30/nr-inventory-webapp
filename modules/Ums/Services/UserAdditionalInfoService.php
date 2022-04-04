<?php

namespace Modules\Ums\Services;

use Modules\Ums\Repositories\UserAdditionalInfoRepository;

class UserAdditionalInfoService
{
    /**
     * @var $userAdditionalInfoRepository
     */
    protected $userAdditionalInfoRepository;

    /**
     * Constructor
     *
     * @param UserAdditionalInfoRepository $userAdditionalInfoRepository
     */
    public function __construct(UserAdditionalInfoRepository $userAdditionalInfoRepository)
    {
        $this->userAdditionalInfoRepository = $userAdditionalInfoRepository;
    }

    /**
     * Get all data
     *
     * @param int $limit
     * @return mixed
     */
    public function all($limit = 0)
    {
        return $this->userAdditionalInfoRepository->paginate($limit);
    }

    /**
     * Get all data
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->userAdditionalInfoRepository->create($data);
    }

    /**
     * Find data
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->userAdditionalInfoRepository->find($id);
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
        return $this->userAdditionalInfoRepository->update($data, $id);
    }

    /**
     * Delete data
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->userAdditionalInfoRepository->delete($id);
    }

    /**
     * First or create data
     *
     * @param $data
     * @return mixed
     */
    public function firstOrCreate($data)
    {
        return $this->userAdditionalInfoRepository->model->firstOrCreate($data);
    }

    /**
     * Find author by author_id
     *
     * @param $attribute
     * @param $value
     * @return mixed
     */
    public function findAuthor($attribute, $value)
    {
        return $this->userAdditionalInfoRepository->findBy($attribute, $value);
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
        return $this->userAdditionalInfoRepository->model->updateOrCreate($attribute, $value);
    }
}
