<?php

namespace Modules\Ums\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Modules\Ums\Http\Requests\UserShippingInfoStoreRequest;
use Modules\Ums\Http\Requests\UserShippingInfoUpdateRequest;

// datatable...
use Modules\Ums\DataTables\UserShippingInfoDataTable;

// services...
use Modules\Ums\Services\UserShippingInfoService;
use Modules\Ums\Services\UserService;

class UserShippingInfoController extends Controller
{
    /**
     * @var $userShippingInfoService
     */
    protected $userShippingInfoService;
    /**
     * @var $userService
     */
    protected $userService;

    /**
     * Constructor
     *
     * @param UserShippingInfoService $userShippingInfoService
     * @param UserService $userService
     */
    public function __construct(UserShippingInfoService $userShippingInfoService, UserService $userService)
    {
        $this->userShippingInfoService = $userShippingInfoService;
        $this->userService = $userService;
    }

    /**
     * UserShippingInfo list
     *
     * @param UserShippingInfoDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function index(UserShippingInfoDataTable $datatable)
    {
        return $datatable->render('ums::user_shipping_info.index');
    }

    /**
     * Create userShippingInfo
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        //users
        $users = $this->userService->all();
        // return view
        return view('ums::user_shipping_info.create', compact('users'));
    }


    /**
     * Store userShippingInfo
     *
     * @param UserShippingInfoStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserShippingInfoStoreRequest $request)
    {
        // create userShippingInfo
        $userShippingInfo = $this->userShippingInfoService->create($request->all());
        // check if userShippingInfo created
        if ($userShippingInfo) {
            // flash notification
            notifier()->success('UserShippingInfo created successfully.');
        } else {
            // flash notification
            notifier()->error('UserShippingInfo cannot be created successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Show userShippingInfo.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get userShippingInfo
        $userShippingInfo = $this->userShippingInfoService->find($id);
        // check if userShippingInfo doesn't exists
        if (empty($userShippingInfo)) {
            // flash notification
            notifier()->error('UserShippingInfo not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('ums::user_shipping_info.show', compact('userShippingInfo'));
    }

    /**
     * Show userShippingInfo.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        //users
        $users = $this->userService->all();
        // get userShippingInfo
        $userShippingInfo = $this->userShippingInfoService->find($id);
        // check if userShippingInfo doesn't exists
        if (empty($userShippingInfo)) {
            // flash notification
            notifier()->error('UserShippingInfo not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('ums::user_shipping_info.edit', compact('userShippingInfo', 'users'));
    }

    /**
     * Update userShippingInfo
     *
     * @param UserShippingInfoUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserShippingInfoUpdateRequest $request, $id)
    {
        // get userShippingInfo
        $userShippingInfo = $this->userShippingInfoService->find($id);
        // check if userShippingInfo doesn't exists
        if (empty($userShippingInfo)) {
            // flash notification
            notifier()->error('UserShippingInfo not found!');
            // redirect back
            return redirect()->back();
        }
        // update userShippingInfo
        $userShippingInfo = $this->userShippingInfoService->update($request->all(), $id);
        // check if userShippingInfo updated
        if ($userShippingInfo) {
            // flash notification
            notifier()->success('UserShippingInfo updated successfully.');
        } else {
            // flash notification
            notifier()->error('UserShippingInfo cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Delete userShippingInfo
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // get userShippingInfo
        $userShippingInfo = $this->userShippingInfoService->find($id);
        // check if userShippingInfo doesn't exists
        if (empty($userShippingInfo)) {
            // flash notification
            notifier()->error('UserShippingInfo not found!');
            // redirect back
            return redirect()->back();
        }
        // delete userShippingInfo
        if ($this->userShippingInfoService->delete($id)) {
            // flash notification
            notifier()->success('UserShippingInfo deleted successfully.');
        } else {
            // flash notification
            notifier()->success('UserShippingInfo cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
