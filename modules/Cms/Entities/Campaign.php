<?php

namespace Modules\Cms\Entities;

use App\BaseModel;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Campaign extends BaseModel implements hasMedia
{
    use Sluggable, HasMediaTrait;

    protected $table = 'campaigns';

    protected $fillable = [
        'title',
		'slug',
		'details',
		'brand_ids',
		'available_until',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'title' => 'string',
		'slug' => 'string',
		'details' => 'string',
		'brand_ids' => 'array',
		'available_until' => 'datetime',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getLogoAttribute()
    {
        $media = $this->getMedia(config('core.media_collection.campaign.logo') ?? '');
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
            if ($this->hasMedia(config('core.media_collection.campaign.logo'))) {
                $this->clearMediaCollection(config('core.media_collection.campaign.logo'));
            }
            // upload new file to collection
            $this->addMediaFromRequest('logo')
                ->toMediaCollection(config('core.media_collection.campaign.logo'));
        }
    }
}
