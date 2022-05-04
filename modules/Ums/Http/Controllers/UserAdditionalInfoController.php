<?php

namespace Modules\Ums\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Modules\Ums\Entities\User;
use Modules\Ums\Http\Requests\UserAdditionalInfoStoreRequest;
use Modules\Ums\Http\Requests\UserAdditionalInfoUpdateRequest;

// datatable...
use Modules\Ums\DataTables\UserAdditionalInfoDataTable;

// services...
use Modules\Ums\Services\UserAdditionalInfoService;
use Modules\Ums\Services\UserService;

class UserAdditionalInfoController extends Controller
{
    /**
     * @var $userAdditionalInfoService
     */
    protected $userAdditionalInfoService;
    /**
     * @var $userService
     */
    protected $userService;

    /**
     * Constructor
     *
     * @param UserAdditionalInfoService $userAdditionalInfoService
     * @param UserService $userService
     */
    public function __construct(UserAdditionalInfoService $userAdditionalInfoService, UserService $userService)
    {
        $this->userAdditionalInfoService = $userAdditionalInfoService;
        $this->userService = $userService;
        $this->middleware(['permission:Core Settings']);
    }

    /**
     * UserAdditionalInfo list
     *
     * @param UserAdditionalInfoDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function index(UserAdditionalInfoDataTable $datatable)
    {
        return $datatable->render('ums::user_additional_info.index');
    }

    /**
     * Create userAdditionalInfo
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // users
        $users = $this->userService->all();
        // return view
        return view('ums::user_additional_info.create', compact('users'));
    }


    /**
     * Store userAdditionalInfo
     *
     * @param UserAdditionalInfoStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserAdditionalInfoStoreRequest $request)
    {
        // create userAdditionalInfo
        $userAdditionalInfo = $this->userAdditionalInfoService->create($request->all());
        // check if userAdditionalInfo created
        if ($userAdditionalInfo) {
            // flash notification
            notifier()->success('UserAdditionalInfo created successfully.');
        } else {
            // flash notification
            notifier()->error('UserAdditionalInfo cannot be created successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Show userAdditionalInfo.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get userAdditionalInfo
        $userAdditionalInfo = $this->userAdditionalInfoService->find($id);
        // check if userAdditionalInfo doesn't exists
        if (empty($userAdditionalInfo)) {
            // flash notification
            notifier()->error('UserAdditionalInfo not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('ums::user_additional_info.show', compact('userAdditionalInfo'));
    }

    /**
     * Show userAdditionalInfo.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // users
        $users = $this->userService->all();
        // get userAdditionalInfo
        $userAdditionalInfo = $this->userAdditionalInfoService->find($id);
        // check if userAdditionalInfo doesn't exists
        if (empty($userAdditionalInfo)) {
            // flash notification
            notifier()->error('UserAdditionalInfo not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('ums::user_additional_info.edit', compact('userAdditionalInfo', 'users'));
    }

    /**
     * Update userAdditionalInfo
     *
     * @param UserAdditionalInfoUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserAdditionalInfoUpdateRequest $request, $id)
    {
        // get userAdditionalInfo
        $userAdditionalInfo = $this->userAdditionalInfoService->find($id);
        // check if userAdditionalInfo doesn't exists
        if (empty($userAdditionalInfo)) {
            // flash notification
            notifier()->error('UserAdditionalInfo not found!');
            // redirect back
            return redirect()->back();
        }
        // update userAdditionalInfo
        $userAdditionalInfo = $this->userAdditionalInfoService->update($request->all(), $id);
        // check if userAdditionalInfo updated
        if ($userAdditionalInfo) {
            // flash notification
            notifier()->success('UserAdditionalInfo updated successfully.');
        } else {
            // flash notification
            notifier()->error('UserAdditionalInfo cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Delete userAdditionalInfo
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // get userAdditionalInfo
        $userAdditionalInfo = $this->userAdditionalInfoService->find($id);
        // check if userAdditionalInfo doesn't exists
        if (empty($userAdditionalInfo)) {
            // flash notification
            notifier()->error('UserAdditionalInfo not found!');
            // redirect back
            return redirect()->back();
        }
        // delete userAdditionalInfo
        if ($this->userAdditionalInfoService->delete($id)) {
            // flash notification
            notifier()->success('UserAdditionalInfo deleted successfully.');
        } else {
            // flash notification
            notifier()->success('UserAdditionalInfo cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
