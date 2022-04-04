<?php

namespace Modules\Ums\Observers;

use Modules\Ums\Entities\UserAdditionalInfo;

class UserAdditionalInfoObserver
{
    /**
     * Handle the UserAdditionalInfo "created" event.
     *
     * @param  UserAdditionalInfo  $userAdditionalInfo
     * @return void
     */
    public function created(UserAdditionalInfo $userAdditionalInfo)
    {
        //
    }

    /**
     * Handle the UserAdditionalInfo "updated" event.
     *
     * @param  UserAdditionalInfo  $userAdditionalInfo
     * @return void
     */
    public function updated(UserAdditionalInfo $userAdditionalInfo)
    {
        //
    }

    /**
     * Handle the UserAdditionalInfo "deleted" event.
     *
     * @param  UserAdditionalInfo  $userAdditionalInfo
     * @return void
     */
    public function deleted(UserAdditionalInfo $userAdditionalInfo)
    {
        //
    }
}
