<?php

namespace Modules\Setting\Providers;

use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    /**
     * Boot the observers.
     */
    public function boot()
    {
        \Modules\Setting\Entities\Site::observe(\Modules\Setting\Observers\SiteObserver::class);
        \Modules\Setting\Entities\Contact::observe(\Modules\Setting\Observers\ContactObserver::class);
        \Modules\Setting\Entities\Seo::observe(\Modules\Setting\Observers\SeoObserver::class);
        \Modules\Setting\Entities\Socialite::observe(\Modules\Setting\Observers\SocialiteObserver::class);
        //[OBSERVER_REGISTER]
    }
}
