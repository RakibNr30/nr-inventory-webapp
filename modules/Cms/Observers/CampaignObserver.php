<?php

namespace Modules\Cms\Observers;

use Modules\Cms\Entities\Campaign;

class CampaignObserver
{
    /**
     * Handle the Campaign "created" event.
     *
     * @param  Campaign  $page
     * @return void
     */
    public function created(Campaign $page)
    {
        //
    }

    /**
     * Handle the Campaign "updated" event.
     *
     * @param  Campaign  $page
     * @return void
     */
    public function updated(Campaign $page)
    {
        //
    }

    /**
     * Handle the Campaign "deleted" event.
     *
     * @param  Campaign  $page
     * @return void
     */
    public function deleted(Campaign $page)
    {
        //
    }
}
