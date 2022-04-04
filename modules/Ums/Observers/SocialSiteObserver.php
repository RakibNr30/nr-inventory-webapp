<?php

namespace Modules\Ums\Observers;

use Modules\Ums\Entities\SocialSite;

class SocialSiteObserver
{
    /**
     * Handle the SocialSite "created" event.
     *
     * @param  SocialSite  $socialSite
     * @return void
     */
    public function created(SocialSite $socialSite)
    {
        //
    }

    /**
     * Handle the SocialSite "updated" event.
     *
     * @param  SocialSite  $socialSite
     * @return void
     */
    public function updated(SocialSite $socialSite)
    {
        //
    }

    /**
     * Handle the SocialSite "deleted" event.
     *
     * @param  SocialSite  $socialSite
     * @return void
     */
    public function deleted(SocialSite $socialSite)
    {
        //
    }
}
