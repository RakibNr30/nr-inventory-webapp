<?php

namespace Modules\Ums\Services;

use Modules\Ums\Repositories\RoleRepository;

class RoleService
{
    /**
     * @var $roleRepository
     */
    protected $roleRepository;

    /**
     * Constructor
     *
     * @param RoleRepository $roleRepository
     */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * Get all data
     *
     * @param int $limit
     * @return mixed
     */
    public function all($limit = 0)
    {
        return $this->roleRepository->paginate($limit);
    }

    /**
     * Get all data
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        // create roles
        $role = $this->roleRepository->create($data);
        // check for permissions
        if (!empty($data['permissions'])) {
            // attach permission
            $role->givePermissionTo($data['permissions']);
        }
        // return role
        return $role;
    }

    /**
     * Find data
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->roleRepository->find($id);
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
        // update role
        $role = $this->roleRepository->update($data, $id);
        // check for permissions
        if (!empty($data['permissions'])) {
            // attach permission
            $role->syncPermissions($data['permissions']);
        }
        // return
        return $role;
    }

    /**
     * Delete data
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->roleRepository->delete($id);
    }
}
