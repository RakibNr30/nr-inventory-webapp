<?php

namespace Modules\Cms\Observers;

use Modules\Cms\Entities\PageCategory;

class PageCategoryObserver
{
    /**
     * Handle the PageCategory "created" event.
     *
     * @param  PageCategory  $pageCategory
     * @return void
     */
    public function created(PageCategory $pageCategory)
    {
        //
    }

    /**
     * Handle the PageCategory "updated" event.
     *
     * @param  PageCategory  $pageCategory
     * @return void
     */
    public function updated(PageCategory $pageCategory)
    {
        //
    }

    /**
     * Handle the PageCategory "deleted" event.
     *
     * @param  PageCategory  $pageCategory
     * @return void
     */
    public function deleted(PageCategory $pageCategory)
    {
        //
    }
}
