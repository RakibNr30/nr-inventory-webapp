<?php

namespace Modules\Cms\Services;

use Modules\Cms\Repositories\PageRepository;
use Modules\Ums\Entities\User;
use Modules\Ums\Repositories\UserRepository;
use Spatie\Permission\Traits\HasRoles;

class PageService
{
    /**
     * @var $pageRepository
     */
    protected $pageRepository;
    /**
     * @var $userRepository
     */
    protected $userRepository;

    /**
     * Constructor
     *
     * @param PageRepository $pageRepository
     * @param UserRepository $userRepository
     */
    public function __construct(PageRepository $pageRepository, UserRepository $userRepository)
    {
        $this->pageRepository = $pageRepository;
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
        return $this->pageRepository->paginate($limit);
    }

    /**
     * Get all data
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->pageRepository->create($data);
    }

    /**
     * Find data
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->pageRepository->find($id);
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
        return $this->pageRepository->update($data, $id);
    }

    /**
     * Delete data
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->pageRepository->delete($id);
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
        return $this->pageRepository->findBy($attribute, $value);
    }

    /**
     * Find data
     *
     * @return mixed
     */

    public function chairman()
    {
        $data = $this->pageRepository->findBy('slug', 'message-from-the-chairman');
        if ($data) {
            $chairman = new \stdClass();
            $user = User::role('Chairman')->first();
            if ($user) {
                $chairman = $this->userRepository->model->with([
                    'additionalInfo'
                ])->where('id', $user->id)->first();
                $chairman['message'] = $data->description;
            }
            return $chairman;
        }
    }
}
