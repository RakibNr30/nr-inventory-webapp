<?php

namespace Modules\Cms\Entities;

use App\BaseModel;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Page extends BaseModel implements hasMedia
{
    use Sluggable, HasMediaTrait;

    protected $table = 'pages';

    protected $fillable = [
        'title',
		'slug',
		'description',
		'page_category_id',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'title' => 'string',
		'slug' => 'string',
		'description' => 'string',
		'page_category_id' => 'integer',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getImageAttribute()
    {
        $media = $this->getMedia(config('core.media_collection.page.image'));
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
        // check for image
        if (request()->hasFile('feature_image')) {
            // remove old file from collection
            if ($this->hasMedia(config('core.media_collection.page.image'))) {
                $this->clearMediaCollection(config('core.media_collection.page.image'));
            }
            // upload new file to collection
            $this->addMediaFromRequest('feature_image')
                ->toMediaCollection(config('core.media_collection.page.image'));
        }
    }
}
