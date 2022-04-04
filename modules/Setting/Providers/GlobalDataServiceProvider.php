<?php

namespace Modules\Setting\Providers;

use Illuminate\Support\ServiceProvider;

// services
use Modules\Setting\Services\SeoService;
use Modules\Setting\Services\SiteService;
use Modules\Setting\Services\ContactService;

class GlobalDataServiceProvider extends ServiceProvider
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
     *
     * @param SiteService $siteService
     * @param ContactService $contactService
     * @param SeoService $seoService
     */
    public function boot
    (
        SiteService $siteService,
        ContactService $contactService,
        SeoService $seoService
    )
    {
        if (!app()->runningInConsole()) {
            // share site settings data
            view()->share('global_site', $siteService->first());
            // share contact settings data
            view()->share('global_contact', $contactService->first());
            // share seo settings data
            view()->share('global_seo', $seoService->first());
        }
    }
}
