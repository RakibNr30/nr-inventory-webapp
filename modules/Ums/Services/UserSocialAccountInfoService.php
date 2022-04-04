<?php

namespace Modules\Ums\Services;

use Modules\Ums\Repositories\UserSocialAccountInfoRepository;

class UserSocialAccountInfoService
{
    /**
     * @var $userSocialAccountInfoRepository
     */
    protected $userSocialAccountInfoRepository;

    /**
     * Constructor
     *
     * @param UserSocialAccountInfoRepository $userSocialAccountInfoRepository
     */
    public function __construct(UserSocialAccountInfoRepository $userSocialAccountInfoRepository)
    {
        $this->userSocialAccountInfoRepository = $userSocialAccountInfoRepository;
    }

    /**
     * Get all data
     *
     * @param int $limit
     * @return mixed
     */
    public function all($limit = 0)
    {
        return $this->userSocialAccountInfoRepository->paginate($limit);
    }

    /**
     * Get all data
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->userSocialAccountInfoRepository->create($data);
    }

    /**
     * Find data
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->userSocialAccountInfoRepository->find($id);
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
        return $this->userSocialAccountInfoRepository->update($data, $id);
    }

    /**
     * Delete data
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->userSocialAccountInfoRepository->delete($id);
    }

    /**
     * First or create data
     *
     * @param $data
     * @return mixed
     */
    public function firstOrCreate($data)
    {
        return $this->userSocialAccountInfoRepository->model->firstOrCreate($data);
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
        return $this->userSocialAccountInfoRepository->model->updateOrCreate($attribute, $value);
    }
}
