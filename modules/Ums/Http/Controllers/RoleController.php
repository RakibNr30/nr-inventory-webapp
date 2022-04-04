<?php

namespace Modules\Ums\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Modules\Ums\Http\Requests\RoleStoreRequest;
use Modules\Ums\Http\Requests\RoleUpdateRequest;

// datatable...
use Modules\Ums\DataTables\RoleDataTable;

// services...
use Modules\Ums\Services\PermissionService;
use Modules\Ums\Services\RoleService;

class RoleController extends Controller
{
    /**
     * @var $roleService
     */
    protected $roleService;

    /**
     * @var $permissionService
     */
    protected $permissionService;

    /**
     * RoleController constructor.
     *
     * @param RoleService $roleService
     * @param PermissionService $permissionService
     */
    public function __construct(RoleService $roleService, PermissionService $permissionService)
    {
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;
    }

    /**
     * Role list
     *
     * @param RoleDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function index(RoleDataTable $datatable)
    {
        return $datatable->render('ums::role.index');
    }

    /**
     * Create role
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // permissions
        $permissions = $this->permissionService->all();
        // return view
        return view('ums::role.create', compact('permissions'));
    }


    /**
     * Store role
     *
     * @param RoleStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RoleStoreRequest $request)
    {
        // create role
        $role = $this->roleService->create($request->all());
        // check if role created
        if ($role) {
            // flash notification
            notifier()->success('Role created successfully.');
        } else {
            // flash notification
            notifier()->error('Role cannot be created successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Show role.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get role
        $role = $this->roleService->find($id);
        // check if role doesn't exists
        if (empty($role)) {
            // flash notification
            notifier()->error('Role not found!');
            // redirect back
            return redirect()->back();
        }
        // given permissions
        $givenPermissions = $role->permissions->pluck('name')->toArray();
        // return view
        return view('ums::role.show', compact('role', 'givenPermissions'));
    }

    /**
     * Show role.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // get role
        $role = $this->roleService->find($id);
        // check if role doesn't exists
        if (empty($role)) {
            // flash notification
            notifier()->error('Role not found!');
            // redirect back
            return redirect()->back();
        }
        // permissions
        $permissions = $this->permissionService->all();
        // given permissions
        $givenPermissions = $role->permissions->pluck('name')->toArray();
        // return view
        return view('ums::role.edit', compact('role', 'permissions', 'givenPermissions'));
    }

    /**
     * Update role
     *
     * @param RoleUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(RoleUpdateRequest $request, $id)
    {
        // get role
        $role = $this->roleService->find($id);
        // check if role doesn't exists
        if (empty($role)) {
            // flash notification
            notifier()->error('Role not found!');
            // redirect back
            return redirect()->back();
        }
        // update role
        $role = $this->roleService->update($request->all(), $id);
        // check if role updated
        if ($role) {
            // flash notification
            notifier()->success('Role updated successfully.');
        } else {
            // flash notification
            notifier()->error('Role cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Delete role
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // get role
        $role = $this->roleService->find($id);
        // check if role doesn't exists
        if (empty($role)) {
            // flash notification
            notifier()->error('Role not found!');
            // redirect back
            return redirect()->back();
        }
        // delete role
        if ($this->roleService->delete($id)) {
            // flash notification
            notifier()->success('Role deleted successfully.');
        } else {
            // flash notification
            notifier()->success('Role cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
