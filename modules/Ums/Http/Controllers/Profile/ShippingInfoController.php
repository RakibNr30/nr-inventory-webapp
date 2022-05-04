<?php

namespace Modules\Ums\Http\Controllers\Profile;

use App\Http\Controllers\Controller;

// requests...
use Modules\Ums\Http\Requests\UserShippingInfoStoreRequest;
use Modules\Ums\Http\Requests\UserShippingInfoUpdateRequest;

// datatable...
use Modules\Ums\DataTables\Profile\UserShippingInfoDataTable;

// services...
use Modules\Ums\Services\UserShippingInfoService;
use Modules\Ums\Services\UserService;

class ShippingInfoController extends Controller
{
    /**
     * @var $userShippingInfoService
     */
    protected $userShippingInfoService;

    /**
     * Constructor
     *
     * @param UserShippingInfoService $userShippingInfoService
     */
    public function __construct(UserShippingInfoService $userShippingInfoService)
    {
        $this->userShippingInfoService = $userShippingInfoService;
        $this->middleware(['permission:profile_shipping_info']);
    }

    /**
     * UserAdditionalInfo list
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // first or create user shipping info
        $userShippingInfo = $this->userShippingInfoService->firstOrCreate([
            'user_id' => auth()->user()->id
        ]);
        // return view
        return view('ums::profile.shipping_info.index', compact('userShippingInfo'));
    }

    /**
     * Store userShippingInfo
     *
     * @param UserShippingInfoStoreRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserShippingInfoStoreRequest $request, $id)
    {
        // create userShippingInfo
        $userShippingInfo = $this->userShippingInfoService->update($request->all(), $id);
        // check if userShippingInfo created
        if ($userShippingInfo) {
            // flash notification
            notifier()->success('Your shipping info updated successfully.');
        } else {
            // flash notification
            notifier()->error('Your shipping info cannot be updated successfully.');
        }
        // redirect back
        return redirect()->back();
    }
}
