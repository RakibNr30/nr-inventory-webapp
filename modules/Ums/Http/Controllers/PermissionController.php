<?php

namespace Modules\Ums\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Modules\Ums\Http\Requests\PermissionStoreRequest;
use Modules\Ums\Http\Requests\PermissionUpdateRequest;

// datatable...
use Modules\Ums\DataTables\PermissionDataTable;

// services...
use Modules\Ums\Services\PermissionService;

class PermissionController extends Controller
{
    /**
     * @var $permissionService
     */
    protected $permissionService;

    /**
     * Constructor
     *
     * @param PermissionService $permissionService
     */
    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    /**
     * Permission list
     *
     * @param PermissionDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function index(PermissionDataTable $datatable)
    {
        return $datatable->render('ums::permission.index');
    }

    /**
     * Create permission
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // return view
        return view('ums::permission.create');
    }


    /**
     * Store permission
     *
     * @param PermissionStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PermissionStoreRequest $request)
    {
        // create permission
        $permission = $this->permissionService->create($request->all());
        // check if permission created
        if ($permission) {
            // flash notification
            notifier()->success('Permission created successfully.');
        } else {
            // flash notification
            notifier()->error('Permission cannot be created successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Show permission.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get permission
        $permission = $this->permissionService->find($id);
        // check if permission doesn't exists
        if (empty($permission)) {
            // flash notification
            notifier()->error('Permission not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('ums::permission.show', compact('permission'));
    }

    /**
     * Show permission.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // get permission
        $permission = $this->permissionService->find($id);
        // check if permission doesn't exists
        if (empty($permission)) {
            // flash notification
            notifier()->error('Permission not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('ums::permission.edit', compact('permission'));
    }

    /**
     * Update permission
     *
     * @param PermissionUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PermissionUpdateRequest $request, $id)
    {
        // get permission
        $permission = $this->permissionService->find($id);
        // check if permission doesn't exists
        if (empty($permission)) {
            // flash notification
            notifier()->error('Permission not found!');
            // redirect back
            return redirect()->back();
        }
        // update permission
        $permission = $this->permissionService->update($request->all(), $id);
        // check if permission updated
        if ($permission) {
            // flash notification
            notifier()->success('Permission updated successfully.');
        } else {
            // flash notification
            notifier()->error('Permission cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Delete permission
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // get permission
        $permission = $this->permissionService->find($id);
        // check if permission doesn't exists
        if (empty($permission)) {
            // flash notification
            notifier()->error('Permission not found!');
            // redirect back
            return redirect()->back();
        }
        // delete permission
        if ($this->permissionService->delete($id)) {
            // flash notification
            notifier()->success('Permission deleted successfully.');
        } else {
            // flash notification
            notifier()->success('Permission cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
