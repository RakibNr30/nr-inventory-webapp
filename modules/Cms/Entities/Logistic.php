<?php

namespace Modules\Cms\Entities;

use App\BaseModel;
use Cviebrock\EloquentSluggable\Sluggable;
use Modules\Ums\Entities\User;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Logistic extends BaseModel implements hasMedia
{
    use HasMediaTrait;

    protected $table = 'logistics';

    protected $fillable = [
        'influencer_id',
		'first_name',
		'last_name',
		'shipping_address',
		'zip',
		'city',
		'country_code',
		'email',
		'product_count',
		'product_id',
		'product_name',
		'product_order',
		'is_shipped_out',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'influencer_id' => 'integer',
        'first_name' => 'string',
        'last_name' => 'string',
        'shipping_address' => 'string',
        'zip' => 'string',
        'city' => 'string',
        'country_code' => 'string',
        'email' => 'string',
        'product_count' => 'integer',
        'product_id' => 'integer',
        'product_name' => 'string',
        'product_order' => 'integer',
        'is_shipped_out' => 'integer',
    ];
}
