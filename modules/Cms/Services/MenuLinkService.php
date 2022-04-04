<?php

namespace Modules\Cms\Services;

use Modules\Cms\Repositories\MenuLinkRepository;

class MenuLinkService
{
    /**
     * @var $menuLinkRepository
     */
    protected $menuLinkRepository;

    /**
     * Constructor
     *
     * @param MenuLinkRepository $menuLinkRepository
     */
    public function __construct(MenuLinkRepository $menuLinkRepository)
    {
        $this->menuLinkRepository = $menuLinkRepository;
    }

    /**
     * Get all data
     *
     * @param int $limit
     * @return mixed
     */
    public function all($limit = 0)
    {
        return $this->menuLinkRepository->paginate($limit);
    }

    /**
     * Get all data
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->menuLinkRepository->create($data);
    }

    /**
     * Find data
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->menuLinkRepository->find($id);
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
        return $this->menuLinkRepository->update($data, $id);
    }

    /**
     * Delete data
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->menuLinkRepository->delete($id);
    }
}
