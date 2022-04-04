<?php

namespace Modules\Cms\Observers;

use Modules\Cms\Entities\MenuLink;

class MenuLinkObserver
{
    /**
     * Handle the MenuLink "created" event.
     *
     * @param  MenuLink  $menuLink
     * @return void
     */
    public function created(MenuLink $menuLink)
    {
        //
    }

    /**
     * Handle the MenuLink "updated" event.
     *
     * @param  MenuLink  $menuLink
     * @return void
     */
    public function updated(MenuLink $menuLink)
    {
        //
    }

    /**
     * Handle the MenuLink "deleted" event.
     *
     * @param  MenuLink  $menuLink
     * @return void
     */
    public function deleted(MenuLink $menuLink)
    {
        //
    }
}
