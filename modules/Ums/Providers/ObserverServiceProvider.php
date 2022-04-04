<?php

namespace Modules\Ums\Providers;

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
        \Modules\Ums\Entities\User::observe(\Modules\Ums\Observers\UserObserver::class);
        \Modules\Ums\Entities\UserAdditionalInfo::observe(\Modules\Ums\Observers\UserAdditionalInfoObserver::class);
        \Modules\Ums\Entities\UserShippingInfo::observe(\Modules\Ums\Observers\UserShippingInfoObserver::class);
        \Modules\Ums\Entities\SocialSite::observe(\Modules\Ums\Observers\SocialSiteObserver::class);
        \Modules\Ums\Entities\UserSocialAccountInfo::observe(\Modules\Ums\Observers\UserSocialAccountInfoObserver::class);
        \Modules\Ums\Entities\UserLanguage::observe(\Modules\Ums\Observers\UserLanguageObserver::class);
        \Modules\Ums\Entities\Role::observe(\Modules\Ums\Observers\RoleObserver::class);
        \Modules\Ums\Entities\Permission::observe(\Modules\Ums\Observers\PermissionObserver::class);
        //[OBSERVER_REGISTER]
    }
}
