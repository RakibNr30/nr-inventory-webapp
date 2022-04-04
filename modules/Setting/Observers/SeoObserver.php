<?php

namespace Modules\Setting\Observers;

use Modules\Setting\Entities\Seo;

class SeoObserver
{
    /**
     * Handle the Seo "created" event.
     *
     * @param  Seo  $seo
     * @return void
     */
    public function created(Seo $seo)
    {
        //
    }

    /**
     * Handle the Seo "updated" event.
     *
     * @param  Seo  $seo
     * @return void
     */
    public function updated(Seo $seo)
    {
        //
    }

    /**
     * Handle the Seo "deleted" event.
     *
     * @param  Seo  $seo
     * @return void
     */
    public function deleted(Seo $seo)
    {
        //
    }
}
