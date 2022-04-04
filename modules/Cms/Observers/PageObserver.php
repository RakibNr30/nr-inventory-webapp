<?php

namespace Modules\Cms\Observers;

use Modules\Cms\Entities\Page;

class PageObserver
{
    /**
     * Handle the Page "created" event.
     *
     * @param  Page  $page
     * @return void
     */
    public function created(Page $page)
    {
        //
    }

    /**
     * Handle the Page "updated" event.
     *
     * @param  Page  $page
     * @return void
     */
    public function updated(Page $page)
    {
        //
    }

    /**
     * Handle the Page "deleted" event.
     *
     * @param  Page  $page
     * @return void
     */
    public function deleted(Page $page)
    {
        //
    }
}
