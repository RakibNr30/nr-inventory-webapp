<?php

namespace Modules\Cms\Services;

use Modules\Cms\Repositories\InfluencerCategoryRepository;

class InfluencerCategoryService
{
    /**
     * @var $influencerCategoryRepository
     */
    protected $influencerCategoryRepository;

    /**
     * Constructor
     *
     * @param InfluencerCategoryRepository $influencerCategoryRepository
     */
    public function __construct(InfluencerCategoryRepository $influencerCategoryRepository)
    {
        $this->influencerCategoryRepository = $influencerCategoryRepository;
    }

    /**
     * Get all data
     *
     * @param int $limit
     * @return mixed
     */
    public function all($limit = 0)
    {
        return $this->influencerCategoryRepository->paginate($limit);
    }

    /**
     * Get all data
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->influencerCategoryRepository->create($data);
    }

    /**
     * Find data
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->influencerCategoryRepository->find($id);
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
        return $this->influencerCategoryRepository->update($data, $id);
    }

    /**
     * Delete data
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->influencerCategoryRepository->delete($id);
    }
}
