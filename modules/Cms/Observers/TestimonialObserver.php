<?php

namespace Modules\Cms\Observers;

use Modules\Cms\Entities\Testimonial;

class TestimonialObserver
{
    /**
     * Handle the Testimonial "created" event.
     *
     * @param  Testimonial  $testimonial
     * @return void
     */
    public function created(Testimonial $testimonial)
    {
        //
    }

    /**
     * Handle the Testimonial "updated" event.
     *
     * @param  Testimonial  $testimonial
     * @return void
     */
    public function updated(Testimonial $testimonial)
    {
        //
    }

    /**
     * Handle the Testimonial "deleted" event.
     *
     * @param  Testimonial  $testimonial
     * @return void
     */
    public function deleted(Testimonial $testimonial)
    {
        //
    }
}
