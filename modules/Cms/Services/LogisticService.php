<?php

namespace Modules\Cms\Services;

use Modules\Cms\Repositories\LogisticRepository;

class LogisticService
{
    /**
     * @var $logisticRepository
     */
    protected $logisticRepository;

    /**
     * Constructor
     *
     * @param LogisticRepository $logisticRepository
     */
    public function __construct(LogisticRepository $logisticRepository)
    {
        $this->logisticRepository = $logisticRepository;
    }

    /**
     * Get all data
     *
     * @param int $limit
     * @return mixed
     */
    public function all($limit = 0)
    {
        return $this->logisticRepository->paginate($limit);
    }

    /**
     * Get all data
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->logisticRepository->create($data);
    }

    /**
     * Find data
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->logisticRepository->find($id);
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
        return $this->logisticRepository->update($data, $id);
    }

    /**
     * Delete data
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->logisticRepository->delete($id);
    }

    /**
     * Find data
     *
     * @param $attribute
     * @param $value
     * @return mixed
     */
    public function findBy($attribute, $value)
    {
        return $this->logisticRepository->findBy($attribute, $value);
    }
}
