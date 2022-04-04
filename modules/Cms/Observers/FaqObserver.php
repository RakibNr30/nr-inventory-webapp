<?php

namespace Modules\Cms\Observers;

use Modules\Cms\Entities\Faq;

class FaqObserver
{
    /**
     * Handle the Faq "created" event.
     *
     * @param  Faq  $faq
     * @return void
     */
    public function created(Faq $faq)
    {
        //
    }

    /**
     * Handle the Faq "updated" event.
     *
     * @param  Faq  $faq
     * @return void
     */
    public function updated(Faq $faq)
    {
        //
    }

    /**
     * Handle the Faq "deleted" event.
     *
     * @param  Faq  $faq
     * @return void
     */
    public function deleted(Faq $faq)
    {
        //
    }
}
