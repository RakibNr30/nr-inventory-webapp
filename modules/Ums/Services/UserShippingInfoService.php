<?php

namespace Modules\Ums\Services;

use Modules\Ums\Repositories\UserShippingInfoRepository;

class UserShippingInfoService
{
    /**
     * @var $userShippingInfoRepository
     */
    protected $userShippingInfoRepository;

    /**
     * Constructor
     *
     * @param UserShippingInfoRepository $userShippingInfoRepository
     */
    public function __construct(UserShippingInfoRepository $userShippingInfoRepository)
    {
        $this->userShippingInfoRepository = $userShippingInfoRepository;
    }

    /**
     * Get all data
     *
     * @param int $limit
     * @return mixed
     */
    public function all($limit = 0)
    {
        return $this->userShippingInfoRepository->paginate($limit);
    }

    /**
     * Get all data
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->userShippingInfoRepository->create($data);
    }

    /**
     * Find data
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->userShippingInfoRepository->find($id);
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
        return $this->userShippingInfoRepository->update($data, $id);
    }

    /**
     * Delete data
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->userShippingInfoRepository->delete($id);
    }

    /**
     * First or create data
     *
     * @param $data
     * @return mixed
     */
    public function firstOrCreate($data)
    {
        return $this->userShippingInfoRepository->model->firstOrCreate($data);
    }
}
