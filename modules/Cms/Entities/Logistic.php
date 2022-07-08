<?php

namespace Modules\Cms\Entities;

use App\BaseModel;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Logistic extends BaseModel implements hasMedia
{
    use HasMediaTrait;

    protected $table = 'logistics';

    protected $fillable = [
        'influencer_id',
		'product_count',
		'product_id',
		'is_shipped_out',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'influencer_id' => 'integer',
        'product_id' => 'integer',
        'product_order' => 'integer',
        'is_shipped_out' => 'integer',
    ];
}
