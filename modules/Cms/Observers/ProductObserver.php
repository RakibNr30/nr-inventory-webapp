<?php

namespace Modules\Cms\Observers;

use Modules\Cms\Entities\Product;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param  Product  $page
     * @return void
     */
    public function created(Product $page)
    {
        //
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param  Product  $page
     * @return void
     */
    public function updated(Product $page)
    {
        //
    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param  Product  $page
     * @return void
     */
    public function deleted(Product $page)
    {
        //
    }
}
