<?php

namespace Modules\Ums\Http\Controllers\Profile;

use App\Http\Controllers\Controller;

// requests...
use Modules\Ums\Http\Requests\UserBusinessInfoUpdateRequest;

// services...
use Modules\Ums\Services\UserBusinessInfoService;

class BusinessInfoController extends Controller
{
    /**
     * @var $userBusinessInfoService
     */
    protected $userBusinessInfoService;

    /**
     * Constructor
     *
     * @param UserBusinessInfoService $userBusinessInfoService
     */
    public function __construct(UserBusinessInfoService $userBusinessInfoService)
    {
        $this->userBusinessInfoService = $userBusinessInfoService;
    }

    /**
     * UserBusiness list
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // first or create user additional info
        $userBusinessInfo = $this->userBusinessInfoService->firstOrCreate([
            'user_id' => auth()->user()->id
        ]);
        // return view
        return view('ums::profile.business_info.index', compact('userBusinessInfo'));
    }

    /**
     * Store userAdditionalInfo
     *
     * @param UserBusinessInfoUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserBusinessInfoUpdateRequest $request, $id)
    {
        // create userBusinessInfo
        $userBusinessInfo = $this->userBusinessInfoService->update($request->all(), $id);
        // check if userBusinessInfo created
        if ($userBusinessInfo) {
            // flash notification
            notifier()->success('Your business info updated successfully.');
        } else {
            // flash notification
            notifier()->error('Your business info cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
