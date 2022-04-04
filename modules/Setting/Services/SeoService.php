<?php

namespace Modules\Setting\Services;

use Modules\Setting\Repositories\SeoRepository;

class SeoService
{
    /**
     * @var $seoRepository
     */
    protected $seoRepository;

    /**
     * Constructor
     *
     * @param SeoRepository $seoRepository
     */
    public function __construct(SeoRepository $seoRepository)
    {
        $this->seoRepository = $seoRepository;
    }

    /**
     * Get all data
     *
     * @param int $limit
     * @return mixed
     */
    public function all($limit = 0)
    {
        return $this->seoRepository->paginate($limit);
    }

    /**
     * Get all data
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->seoRepository->create($data);
    }

    /**
     * Find data
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->seoRepository->find($id);
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
        return $this->seoRepository->update($data, $id);
    }

    /**
     * Delete data
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->seoRepository->delete($id);
    }

    /**
     * First or create data
     *
     * @param $data
     * @return mixed
     */
    public function firstOrCreate($data)
    {
        return $this->seoRepository->model->firstOrCreate($data);
    }

    /**
     * First data
     *
     * @return mixed
     */
    public function first()
    {
        return $this->seoRepository->model->first();
    }
}
