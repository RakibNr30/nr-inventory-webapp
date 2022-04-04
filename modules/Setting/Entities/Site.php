<?php

namespace Modules\Setting\Entities;

use App\BaseModel;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Site extends BaseModel implements HasMedia
{
    use HasMediaTrait;

    protected $table = 'sites';

    protected $fillable = [
        'title',
		'description',
    ];

    protected $hidden = [

    ];

    protected $appends = [
        'logo',
        'logo_secondary',
        'favicon',
        'banner_image',
        'breadcrumb_image',
        'parallax_image_1',
        'parallax_image_2',
        'parallax_image_3',
        'footer_image'
    ];

    protected $casts = [
        'title' => 'string',
		'description' => 'string',
    ];

    public function getLogoAttribute()
    {
        $media = $this->getMedia(config('core.media_collection.setting_site.logo'));
        if (isset($media[0])) {
            return json_decode(json_encode([
                'file_name' => $media[0]->file_name,
                'file_url' => $media[0]->getUrl()
            ]));
        }
        return null;
    }

    public function getLogoSecondaryAttribute()
    {
        $media = $this->getMedia(config('core.media_collection.setting_site.logo_secondary'));
        if (isset($media[0])) {
            return json_decode(json_encode([
                'file_name' => $media[0]->file_name,
                'file_url' => $media[0]->getUrl()
            ]));
        }
        return null;
    }

    public function getFaviconAttribute()
    {
        $media = $this->getMedia(config('core.media_collection.setting_site.favicon'));
        if (isset($media[0])) {
            return json_decode(json_encode([
                'file_name' => $media[0]->file_name,
                'file_url' => $media[0]->getUrl()
            ]));
        }
        return null;
    }

    public function getBannerImageAttribute()
    {
        $media = $this->getMedia(config('core.media_collection.setting_site.banner_image'));
        if (isset($media[0])) {
            return json_decode(json_encode([
                'file_name' => $media[0]->file_name,
                'file_url' => $media[0]->getUrl()
            ]));
        }
        return null;
    }

    public function getBreadcrumbImageAttribute()
    {
        $media = $this->getMedia(config('core.media_collection.setting_site.breadcrumb_image'));
        if (isset($media[0])) {
            return json_decode(json_encode([
                'file_name' => $media[0]->file_name,
                'file_url' => $media[0]->getUrl()
            ]));
        }
        return null;
    }

    public function getParallaxImage1Attribute()
    {
        $media = $this->getMedia(config('core.media_collection.setting_site.parallax_image_1'));
        if (isset($media[0])) {
            return json_decode(json_encode([
                'file_name' => $media[0]->file_name,
                'file_url' => $media[0]->getUrl()
            ]));
        }
        return null;
    }

    public function getParallaxImage2Attribute()
    {
        $media = $this->getMedia(config('core.media_collection.setting_site.parallax_image_2'));
        if (isset($media[0])) {
            return json_decode(json_encode([
                'file_name' => $media[0]->file_name,
                'file_url' => $media[0]->getUrl()
            ]));
        }
        return null;
    }

    public function getParallaxImage3Attribute()
    {
        $media = $this->getMedia(config('core.media_collection.setting_site.parallax_image_3'));
        if (isset($media[0])) {
            return json_decode(json_encode([
                'file_name' => $media[0]->file_name,
                'file_url' => $media[0]->getUrl()
            ]));
        }
        return null;
    }

    public function getFooterImageAttribute()
    {
        $media = $this->getMedia(config('core.media_collection.setting_site.footer_image'));
        if (isset($media[0])) {
            return json_decode(json_encode([
                'file_name' => $media[0]->file_name,
                'file_url' => $media[0]->getUrl()
            ]));
        }
        return null;
    }

    public function uploadFiles()
    {
        // check for logo
        if (request()->hasFile('logo')) {
            // remove old file from collection
            if ($this->hasMedia(config('core.media_collection.setting_site.logo'))) {
                $this->clearMediaCollection(config('core.media_collection.setting_site.logo'));
            }
            // upload new file to collection
            $this->addMediaFromRequest('logo')
                ->toMediaCollection(config('core.media_collection.setting_site.logo'));
        }

        // check for logo secondary
        if (request()->hasFile('logo_secondary')) {
            // remove old file from collection
            if ($this->hasMedia(config('core.media_collection.setting_site.logo_secondary'))) {
                $this->clearMediaCollection(config('core.media_collection.setting_site.logo_secondary'));
            }
            // upload new file to collection
            $this->addMediaFromRequest('logo_secondary')
                ->toMediaCollection(config('core.media_collection.setting_site.logo_secondary'));
        }

        // check for favicon
        if (request()->hasFile('favicon')) {
            // remove old file from collection
            if ($this->hasMedia(config('core.media_collection.setting_site.favicon'))) {
                $this->clearMediaCollection(config('core.media_collection.setting_site.favicon'));
            }
            // upload new file to collection
            $this->addMediaFromRequest('favicon')
                ->toMediaCollection(config('core.media_collection.setting_site.favicon'));
        }

        // check for banner image
        if (request()->hasFile('banner_image')) {
            // remove old file from collection
            if ($this->hasMedia(config('core.media_collection.setting_site.banner_image'))) {
                $this->clearMediaCollection(config('core.media_collection.setting_site.banner_image'));
            }
            // upload new file to collection
            $this->addMediaFromRequest('banner_image')
                ->toMediaCollection(config('core.media_collection.setting_site.banner_image'));
        }

        // check for banner image
        if (request()->hasFile('breadcrumb_image')) {
            // remove old file from collection
            if ($this->hasMedia(config('core.media_collection.setting_site.breadcrumb_image'))) {
                $this->clearMediaCollection(config('core.media_collection.setting_site.breadcrumb_image'));
            }
            // upload new file to collection
            $this->addMediaFromRequest('breadcrumb_image')
                ->toMediaCollection(config('core.media_collection.setting_site.breadcrumb_image'));
        }

        // check for parallax image 1
        if (request()->hasFile('parallax_image_1')) {
            // remove old file from collection
            if ($this->hasMedia(config('core.media_collection.setting_site.parallax_image_1'))) {
                $this->clearMediaCollection(config('core.media_collection.setting_site.parallax_image_1'));
            }
            // upload new file to collection
            $this->addMediaFromRequest('parallax_image_1')
                ->toMediaCollection(config('core.media_collection.setting_site.parallax_image_1'));
        }

        // check for parallax image 2
        if (request()->hasFile('parallax_image_2')) {
            // remove old file from collection
            if ($this->hasMedia(config('core.media_collection.setting_site.parallax_image_2'))) {
                $this->clearMediaCollection(config('core.media_collection.setting_site.parallax_image_2'));
            }
            // upload new file to collection
            $this->addMediaFromRequest('parallax_image_2')
                ->toMediaCollection(config('core.media_collection.setting_site.parallax_image_2'));
        }

        // check for parallax image 3
        if (request()->hasFile('parallax_image_3')) {
            // remove old file from collection
            if ($this->hasMedia(config('core.media_collection.setting_site.parallax_image_3'))) {
                $this->clearMediaCollection(config('core.media_collection.setting_site.parallax_image_3'));
            }
            // upload new file to collection
            $this->addMediaFromRequest('parallax_image_3')
                ->toMediaCollection(config('core.media_collection.setting_site.parallax_image_3'));
        }

        // check for footer image
        if (request()->hasFile('footer_image')) {
            // remove old file from collection
            if ($this->hasMedia(config('core.media_collection.setting_site.footer_image'))) {
                $this->clearMediaCollection(config('core.media_collection.setting_site.footer_image'));
            }
            // upload new file to collection
            $this->addMediaFromRequest('footer_image')
                ->toMediaCollection(config('core.media_collection.setting_site.footer_image'));
        }
    }
}
