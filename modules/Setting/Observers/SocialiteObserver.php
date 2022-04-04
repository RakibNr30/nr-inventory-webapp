<?php

namespace Modules\Setting\Observers;

use Modules\Setting\Entities\Socialite;

class SocialiteObserver
{
    /**
     * Handle the Socialite "created" event.
     *
     * @param  Socialite  $socialite
     * @return void
     */
    public function created(Socialite $socialite)
    {
        //
    }

    /**
     * Handle the Socialite "updated" event.
     *
     * @param  Socialite  $socialite
     * @return void
     */
    public function updated(Socialite $socialite)
    {
        //
    }

    /**
     * Handle the Socialite "deleted" event.
     *
     * @param  Socialite  $socialite
     * @return void
     */
    public function deleted(Socialite $socialite)
    {
        //
    }
}
