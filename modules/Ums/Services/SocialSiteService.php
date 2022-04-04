<?php

namespace Modules\Ums\Services;

use Modules\Ums\Repositories\SocialSiteRepository;

class SocialSiteService
{
    /**
     * @var $socialSiteRepository
     */
    protected $socialSiteRepository;

    /**
     * Constructor
     *
     * @param SocialSiteRepository $socialSiteRepository
     */
    public function __construct(SocialSiteRepository $socialSiteRepository)
    {
        $this->socialSiteRepository = $socialSiteRepository;
    }

    /**
     * Get all data
     *
     * @param int $limit
     * @return mixed
     */
    public function all($limit = 0)
    {
        return $this->socialSiteRepository->paginate($limit);
    }

    /**
     * Get all data
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->socialSiteRepository->create($data);
    }

    /**
     * Find data
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->socialSiteRepository->find($id);
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
        return $this->socialSiteRepository->update($data, $id);
    }

    /**
     * Delete data
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->socialSiteRepository->delete($id);
    }
}
