<?php

namespace Modules\Cms\Observers;

use Modules\Cms\Entities\Menu;

class MenuObserver
{
    /**
     * Handle the Menu "created" event.
     *
     * @param  Menu  $menu
     * @return void
     */
    public function created(Menu $menu)
    {
        //
    }

    /**
     * Handle the Menu "updated" event.
     *
     * @param  Menu  $menu
     * @return void
     */
    public function updated(Menu $menu)
    {
        //
    }

    /**
     * Handle the Menu "deleted" event.
     *
     * @param  Menu  $menu
     * @return void
     */
    public function deleted(Menu $menu)
    {
        //
    }
}
