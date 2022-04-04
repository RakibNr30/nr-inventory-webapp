<?php

namespace Modules\Ums\Observers;

use Modules\Ums\Entities\UserShippingInfo;

class UserShippingInfoObserver
{
    /**
     * Handle the UserShippingInfo "created" event.
     *
     * @param  UserShippingInfo  $userShippingInfo
     * @return void
     */
    public function created(UserShippingInfo $userShippingInfo)
    {
        //
    }

    /**
     * Handle the UserShippingInfo "updated" event.
     *
     * @param  UserShippingInfo  $userShippingInfo
     * @return void
     */
    public function updated(UserShippingInfo $userShippingInfo)
    {
        //
    }

    /**
     * Handle the UserShippingInfo "deleted" event.
     *
     * @param  UserShippingInfo  $userShippingInfo
     * @return void
     */
    public function deleted(UserShippingInfo $userShippingInfo)
    {
        //
    }
}
