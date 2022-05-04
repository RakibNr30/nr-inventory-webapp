<?php

namespace Modules\Ums\Http\Controllers\Profile;

use App\Http\Controllers\Controller;

// requests...
use Modules\Ums\Http\Requests\UserSocialAccountInfoUpdateRequest;

// services...
use Modules\Ums\Services\UserSocialAccountInfoService;

class SocialAccountInfoController extends Controller
{
    /**
     * @var $userSocialAccountInfoService
     */
    protected $userSocialAccountInfoService;

    /**
     * Constructor
     *
     * @param UserSocialAccountInfoService $userSocialAccountInfoService
     */
    public function __construct(UserSocialAccountInfoService $userSocialAccountInfoService)
    {
        $this->userSocialAccountInfoService = $userSocialAccountInfoService;
        $this->middleware(['permission:profile_social_account_info']);
    }

    /**
     * UserSocialAccount list
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // first or create user additional info
        $userSocialAccountInfo = $this->userSocialAccountInfoService->firstOrCreate([
            'user_id' => auth()->user()->id
        ]);
        // return view
        return view('ums::profile.social_account_info.index', compact('userSocialAccountInfo'));
    }

    /**
     * Store userAdditionalInfo
     *
     * @param UserSocialAccountInfoUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserSocialAccountInfoUpdateRequest $request, $id)
    {
        // create userSocialAccountInfo
        $userSocialAccountInfo = $this->userSocialAccountInfoService->update($request->all(), $id);
        // check if userSocialAccountInfo created
        if ($userSocialAccountInfo) {
            // flash notification
            notifier()->success('Your social account info updated successfully.');
        } else {
            // flash notification
            notifier()->error('Your social account info cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
