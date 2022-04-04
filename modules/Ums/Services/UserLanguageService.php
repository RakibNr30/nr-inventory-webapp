<?php

namespace Modules\Ums\Services;

use Modules\Ums\Repositories\UserLanguageRepository;

class UserLanguageService
{
    /**
     * @var $userLanguageRepository
     */
    protected $userLanguageRepository;

    /**
     * Constructor
     *
     * @param UserLanguageRepository $userLanguageRepository
     */
    public function __construct(UserLanguageRepository $userLanguageRepository)
    {
        $this->userLanguageRepository = $userLanguageRepository;
    }

    /**
     * Get all data
     *
     * @param int $limit
     * @return mixed
     */
    public function all($limit = 0)
    {
        return $this->userLanguageRepository->paginate($limit);
    }

    /**
     * Get all data
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->userLanguageRepository->create($data);
    }

    /**
     * Find data
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->userLanguageRepository->find($id);
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
        return $this->userLanguageRepository->update($data, $id);
    }

    /**
     * Delete data
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->userLanguageRepository->delete($id);
    }
}
