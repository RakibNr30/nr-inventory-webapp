<?php

namespace Modules\Ums\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Modules\Ums\Http\Requests\UserSocialAccountStoreRequest;
use Modules\Ums\Http\Requests\UserSocialAccountInfoUpdateRequest;

// datatable...
use Modules\Ums\DataTables\UserSocialAccountDataTable;

// services...
use Modules\Ums\Services\UserService;
use Modules\Ums\Services\UserSocialAccountInfoService;

class UserSocialAccountController extends Controller
{
    /**
     * @var $userSocialAccountService
     */
    protected $userSocialAccountService;
    /**
     * @var $userService
     */
    protected $userService;

    /**
     * Constructor
     *
     * @param UserSocialAccountInfoService $userSocialAccountService
     * @param UserService $userService
     */
    public function __construct(UserSocialAccountInfoService $userSocialAccountService, UserService $userService)
    {
        $this->userSocialAccountService = $userSocialAccountService;
        $this->userService = $userService;
        $this->middleware(['permission:Core Settings']);
    }

    /**
     * UserSocialAccount list
     *
     * @param UserSocialAccountDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function index(UserSocialAccountDataTable $datatable)
    {
        return $datatable->render('ums::user_social_account.index');
    }

    /**
     * Create userSocialAccount
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // users
        $users = $this->userService->all();
        // return view
        return view('ums::user_social_account.create', compact('users'));
    }


    /**
     * Store userSocialAccount
     *
     * @param UserSocialAccountStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserSocialAccountStoreRequest $request)
    {
        // create userSocialAccount
        $userSocialAccount = $this->userSocialAccountService->create($request->all());
        // check if userSocialAccount created
        if ($userSocialAccount) {
            // flash notification
            notifier()->success('UserSocialAccount created successfully.');
        } else {
            // flash notification
            notifier()->error('UserSocialAccount cannot be created successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Show userSocialAccount.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get userSocialAccount
        $userSocialAccount = $this->userSocialAccountService->find($id);
        // check if userSocialAccount doesn't exists
        if (empty($userSocialAccount)) {
            // flash notification
            notifier()->error('UserSocialAccount not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('ums::user_social_account.show', compact('userSocialAccount'));
    }

    /**
     * Show userSocialAccount.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // users
        $users = $this->userService->all();
        // get userSocialAccount
        $userSocialAccount = $this->userSocialAccountService->find($id);
        // check if userSocialAccount doesn't exists
        if (empty($userSocialAccount)) {
            // flash notification
            notifier()->error('UserSocialAccount not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('ums::user_social_account.edit', compact('userSocialAccount', 'users'));
    }

    /**
     * Update userSocialAccount
     *
     * @param UserSocialAccountInfoUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserSocialAccountInfoUpdateRequest $request, $id)
    {
        // get userSocialAccount
        $userSocialAccount = $this->userSocialAccountService->find($id);
        // check if userSocialAccount doesn't exists
        if (empty($userSocialAccount)) {
            // flash notification
            notifier()->error('UserSocialAccount not found!');
            // redirect back
            return redirect()->back();
        }
        // update userSocialAccount
        $userSocialAccount = $this->userSocialAccountService->update($request->all(), $id);
        // check if userSocialAccount updated
        if ($userSocialAccount) {
            // flash notification
            notifier()->success('UserSocialAccount updated successfully.');
        } else {
            // flash notification
            notifier()->error('UserSocialAccount cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Delete userSocialAccount
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // get userSocialAccount
        $userSocialAccount = $this->userSocialAccountService->find($id);
        // check if userSocialAccount doesn't exists
        if (empty($userSocialAccount)) {
            // flash notification
            notifier()->error('UserSocialAccount not found!');
            // redirect back
            return redirect()->back();
        }
        // delete userSocialAccount
        if ($this->userSocialAccountService->delete($id)) {
            // flash notification
            notifier()->success('UserSocialAccount deleted successfully.');
        } else {
            // flash notification
            notifier()->success('UserSocialAccount cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
