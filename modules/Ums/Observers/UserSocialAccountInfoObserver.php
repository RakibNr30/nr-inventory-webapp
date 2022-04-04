<?php

namespace Modules\Ums\Observers;

use Modules\Ums\Entities\UserSocialAccountInfo;

class UserSocialAccountInfoObserver
{
    /**
     * Handle the UserSocialAccount "created" event.
     *
     * @param  UserSocialAccountInfo  $userSocialAccount
     * @return void
     */
    public function created(UserSocialAccountInfo $userSocialAccount)
    {
        //
    }

    /**
     * Handle the UserSocialAccount "updated" event.
     *
     * @param  UserSocialAccountInfo  $userSocialAccount
     * @return void
     */
    public function updated(UserSocialAccountInfo $userSocialAccount)
    {
        //
    }

    /**
     * Handle the UserSocialAccount "deleted" event.
     *
     * @param  UserSocialAccountInfo  $userSocialAccount
     * @return void
     */
    public function deleted(UserSocialAccountInfo $userSocialAccount)
    {
        //
    }
}
