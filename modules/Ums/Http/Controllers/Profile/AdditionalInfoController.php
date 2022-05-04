<?php

namespace Modules\Ums\Http\Controllers\Profile;

use App\Http\Controllers\Controller;

// requests...
use Modules\Ums\Http\Requests\UserAdditionalInfoStoreRequest;

// services...
use Modules\Ums\Services\UserAdditionalInfoService;

class AdditionalInfoController extends Controller
{
    /**
     * @var $userAdditionalInfoService
     */
    protected $userAdditionalInfoService;

    /**
     * Constructor
     *
     * @param UserAdditionalInfoService $userAdditionalInfoService
     */
    public function __construct(UserAdditionalInfoService $userAdditionalInfoService)
    {
        $this->userAdditionalInfoService = $userAdditionalInfoService;
        $this->middleware(['permission:profile_additional_info']);
    }

    /**
     * UserAdditionalInfo list
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // first or create user additional info
        $userAdditionalInfo = $this->userAdditionalInfoService->firstOrCreate([
            'user_id' => auth()->user()->id
        ]);
        // return view
        return view('ums::profile.additional_info.index', compact('userAdditionalInfo'));
    }

    /**
     * Store userAdditionalInfo
     *
     * @param UserAdditionalInfoStoreRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserAdditionalInfoStoreRequest $request, $id)
    {
        // create userAdditionalInfo
        $userAdditionalInfo = $this->userAdditionalInfoService->update($request->all(), $id);
        // upload files
        $userAdditionalInfo->uploadFiles();
        // check if userAdditionalInfo created
        if ($userAdditionalInfo) {
            // flash notification
            notifier()->success('Your additional info updated successfully.');
        } else {
            // flash notification
            notifier()->error('Your additional info cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
