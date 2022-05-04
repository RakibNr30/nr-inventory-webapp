<?php

namespace Modules\Ums\Http\Controllers;

use App\Http\Controllers\Controller;

// requests...
use Modules\Ums\Http\Requests\UserLanguageStoreRequest;
use Modules\Ums\Http\Requests\UserLanguageUpdateRequest;

// datatable...
use Modules\Ums\DataTables\UserLanguageDataTable;

// services...
use Modules\Ums\Services\UserLanguageService;
use Modules\Ums\Services\UserService;

class UserLanguageController extends Controller
{
    /**
     * @var $userLanguageService
     */
    protected $userLanguageService;
    /**
     * @var $userService
     */
    protected $userService;

    /**
     * Constructor
     *
     * @param UserLanguageService $userLanguageService
     * @param UserService $userService
     */
    public function __construct(UserLanguageService $userLanguageService, UserService $userService)
    {
        $this->userLanguageService = $userLanguageService;
        $this->userService = $userService;
        $this->middleware(['permission:Core Settings']);
    }

    /**
     * UserLanguage list
     *
     * @param UserLanguageDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function index(UserLanguageDataTable $datatable)
    {
        return $datatable->render('ums::user_language.index');
    }

    /**
     * Create userLanguage
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        //users
        $users = $this->userService->all();
        // return view
        return view('ums::user_language.create', compact('users'));
    }


    /**
     * Store userLanguage
     *
     * @param UserLanguageStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserLanguageStoreRequest $request)
    {
        // create userLanguage
        $userLanguage = $this->userLanguageService->create($request->all());
        // check if userLanguage created
        if ($userLanguage) {
            // flash notification
            notifier()->success('UserLanguage created successfully.');
        } else {
            // flash notification
            notifier()->error('UserLanguage cannot be created successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Show userLanguage.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get userLanguage
        $userLanguage = $this->userLanguageService->find($id);
        // check if userLanguage doesn't exists
        if (empty($userLanguage)) {
            // flash notification
            notifier()->error('UserLanguage not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('ums::user_language.show', compact('userLanguage'));
    }

    /**
     * Show userLanguage.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // users
        $users = $this->userService->all();
        // get userLanguage
        $userLanguage = $this->userLanguageService->find($id);
        // check if userLanguage doesn't exists
        if (empty($userLanguage)) {
            // flash notification
            notifier()->error('UserLanguage not found!');
            // redirect back
            return redirect()->back();
        }
        // return view
        return view('ums::user_language.edit', compact('userLanguage', 'users'));
    }

    /**
     * Update userLanguage
     *
     * @param UserLanguageUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserLanguageUpdateRequest $request, $id)
    {
        // get userLanguage
        $userLanguage = $this->userLanguageService->find($id);
        // check if userLanguage doesn't exists
        if (empty($userLanguage)) {
            // flash notification
            notifier()->error('UserLanguage not found!');
            // redirect back
            return redirect()->back();
        }
        // update userLanguage
        $userLanguage = $this->userLanguageService->update($request->all(), $id);
        // check if userLanguage updated
        if ($userLanguage) {
            // flash notification
            notifier()->success('UserLanguage updated successfully.');
        } else {
            // flash notification
            notifier()->error('UserLanguage cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }

    /**
     * Delete userLanguage
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // get userLanguage
        $userLanguage = $this->userLanguageService->find($id);
        // check if userLanguage doesn't exists
        if (empty($userLanguage)) {
            // flash notification
            notifier()->error('UserLanguage not found!');
            // redirect back
            return redirect()->back();
        }
        // delete userLanguage
        if ($this->userLanguageService->delete($id)) {
            // flash notification
            notifier()->success('UserLanguage deleted successfully.');
        } else {
            // flash notification
            notifier()->success('UserLanguage cannot be deleted successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
