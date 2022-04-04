<?php

namespace Modules\Setting\Observers;

use Modules\Setting\Entities\Contact;

class ContactObserver
{
    /**
     * Handle the Contact "created" event.
     *
     * @param  Contact  $contact
     * @return void
     */
    public function created(Contact $contact)
    {
        //
    }

    /**
     * Handle the Contact "updated" event.
     *
     * @param  Contact  $contact
     * @return void
     */
    public function updated(Contact $contact)
    {
        //
    }

    /**
     * Handle the Contact "deleted" event.
     *
     * @param  Contact  $contact
     * @return void
     */
    public function deleted(Contact $contact)
    {
        //
    }
}
