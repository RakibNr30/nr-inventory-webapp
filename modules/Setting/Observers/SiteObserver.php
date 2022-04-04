<?php

namespace Modules\Setting\Observers;

use Modules\Setting\Entities\Site;

class SiteObserver
{
    /**
     * Handle the Site "created" event.
     *
     * @param  Site  $site
     * @return void
     */
    public function created(Site $site)
    {
        //
    }

    /**
     * Handle the Site "updated" event.
     *
     * @param  Site  $site
     * @return void
     */
    public function updated(Site $site)
    {
        //
    }

    /**
     * Handle the Site "deleted" event.
     *
     * @param  Site  $site
     * @return void
     */
    public function deleted(Site $site)
    {
        //
    }
}
