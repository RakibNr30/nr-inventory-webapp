<?php

namespace Modules\Ums\Http\Controllers\Profile;

use App\Http\Controllers\Controller;

// requests...
use Modules\Ums\Http\Requests\UserLanguageStoreRequest;
use Modules\Ums\Http\Requests\UserLanguageUpdateRequest;

// datatable...
use Modules\Ums\DataTables\Profile\LanguageDataTable;

// services...
use Modules\Ums\Services\UserLanguageService;
use Modules\Ums\Services\UserService;

class LanguageController extends Controller
{
    /**
     * @var $userLanguageService
     */
    protected $userLanguageService;

    /**
     * Constructor
     *
     * @param UserLanguageService $userLanguageService
     */
    public function __construct(UserLanguageService $userLanguageService)
    {
        $this->userLanguageService = $userLanguageService;
    }

    /**
     * UserLanguage list
     *
     * @param LanguageDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function index(LanguageDataTable $datatable)
    {
        return $datatable->render('ums::profile.language.index');
    }

    /**
     * Create userLanguage
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // return view
        return view('ums::profile.language.create');
    }


    /**
     * Store userLanguage
     *
     * @param UserLanguageStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserLanguageStoreRequest $request)
    {
        // get request data
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        // create userLanguage
        $userLanguage = $this->userLanguageService->create($data);
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
        return view('ums::profile.language.show', compact('userLanguage'));
    }

    /**
     * Show userLanguage.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
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
        return view('ums::profile.language.edit', compact('userLanguage'));
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
