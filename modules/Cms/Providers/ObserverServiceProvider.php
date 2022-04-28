<?php

namespace Modules\Cms\Providers;

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
        \Modules\Cms\Entities\Slider::observe(\Modules\Cms\Observers\SliderObserver::class);
        \Modules\Cms\Entities\Menu::observe(\Modules\Cms\Observers\MenuObserver::class);
        \Modules\Cms\Entities\MenuLink::observe(\Modules\Cms\Observers\MenuLinkObserver::class);
        \Modules\Cms\Entities\PageCategory::observe(\Modules\Cms\Observers\PageCategoryObserver::class);
        \Modules\Cms\Entities\Page::observe(\Modules\Cms\Observers\PageObserver::class);
        \Modules\Cms\Entities\Faq::observe(\Modules\Cms\Observers\FaqObserver::class);
        \Modules\Cms\Entities\Testimonial::observe(\Modules\Cms\Observers\TestimonialObserver::class);
        \Modules\Cms\Entities\Campaign::observe(\Modules\Cms\Observers\CampaignObserver::class);
        \Modules\Cms\Entities\Product::observe(\Modules\Cms\Observers\ProductObserver::class);
        //[OBSERVER_REGISTER]
    }
}
