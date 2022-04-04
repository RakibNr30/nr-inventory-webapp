<?php

namespace Modules\Ums\Observers;

use Modules\Ums\Entities\Permission;

class PermissionObserver
{
    /**
     * Handle the Permission "created" event.
     *
     * @param  Permission  $permission
     * @return void
     */
    public function created(Permission $permission)
    {
        //
    }

    /**
     * Handle the Permission "updated" event.
     *
     * @param  Permission  $permission
     * @return void
     */
    public function updated(Permission $permission)
    {
        //
    }

    /**
     * Handle the Permission "deleted" event.
     *
     * @param  Permission  $permission
     * @return void
     */
    public function deleted(Permission $permission)
    {
        //
    }
}
