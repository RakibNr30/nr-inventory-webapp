<?php

namespace Modules\Cms\Entities;

use App\BaseModel;
use Cviebrock\EloquentSluggable\Sluggable;
use Modules\Ums\Entities\User;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Product extends BaseModel implements hasMedia
{
    use HasMediaTrait;

    protected $table = 'products';

    protected $fillable = [
        'title',
		'priority',
		'stock_amount',
		'details',
		'brand_id',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'title' => 'string',
		'priority' => 'integer',
		'stock_amount' => 'integer',
		'details' => 'string',
		'brand_id' => 'integer',
    ];

    public function getImageAttribute()
    {
        $media = $this->getMedia(config('core.media_collection.product.image') ?? '');
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
        if (request()->hasFile('image')) {
            // remove old file from collection
            if ($this->hasMedia(config('core.media_collection.product.image'))) {
                $this->clearMediaCollection(config('core.media_collection.product.image'));
            }
            // upload new file to collection
            $this->addMediaFromRequest('image')
                ->toMediaCollection(config('core.media_collection.product.image'));
        }
    }

    public function brand() {
        return $this->hasOne(User::class, 'id', 'brand_id');
    }
}
