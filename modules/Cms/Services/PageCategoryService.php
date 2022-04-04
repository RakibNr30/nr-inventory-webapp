<?php

namespace Modules\Cms\Services;

use Modules\Cms\Repositories\PageCategoryRepository;

class PageCategoryService
{
    /**
     * @var $pageCategoryRepository
     */
    protected $pageCategoryRepository;

    /**
     * Constructor
     *
     * @param PageCategoryRepository $pageCategoryRepository
     */
    public function __construct(PageCategoryRepository $pageCategoryRepository)
    {
        $this->pageCategoryRepository = $pageCategoryRepository;
    }

    /**
     * Get all data
     *
     * @param int $limit
     * @return mixed
     */
    public function all($limit = 0)
    {
        return $this->pageCategoryRepository->paginate($limit);
    }

    /**
     * Get all data
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->pageCategoryRepository->create($data);
    }

    /**
     * Find data
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->pageCategoryRepository->find($id);
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
        return $this->pageCategoryRepository->update($data, $id);
    }

    /**
     * Delete data
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->pageCategoryRepository->delete($id);
    }
}
