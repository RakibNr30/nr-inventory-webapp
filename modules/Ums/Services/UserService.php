<?php

namespace Modules\Ums\Services;

use Modules\Ums\Repositories\UserRepository;

class UserService
{
    /**
     * @var $userRepository
     */
    protected $userRepository;

    /**
     * Constructor
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get all data
     *
     * @param int $limit
     * @return mixed
     */
    public function all($limit = 0)
    {
        return $this->userRepository->paginate($limit);
    }

    /**
     * Get all data
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->userRepository->create($data);
    }

    /**
     * Find data
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->userRepository->find($id);
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
        return $this->userRepository->update($data, $id);
    }

    /**
     * Delete data
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->userRepository->delete($id);
    }

    /**
     * Author data
     *
     * @param $id
     * @return mixed
     */
    public function authorInfo($id)
    {
        return $this->userRepository->model->with([
            'additionalInfo'
        ])->where('id', $id)->first();
    }

    /**
     * First or create data
     *
     * @param $data
     * @return mixed
     */
    public function firstOrCreate($data)
    {
        return $this->userRepository->model->firstOrCreate($data);
    }

    public function influencers($limit = 0)
    {
        return $this->userRepository->model->with(['additionalInfo', 'shippingInfo', 'socialAccountInfo'])
            ->whereHas("roles", function ($query) {
                $query->where("name", "Influencer");
            })->paginate($limit);
    }
}
