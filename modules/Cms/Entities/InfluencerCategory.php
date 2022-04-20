<?php

namespace Modules\Cms\Entities;

use App\BaseModel;
use Cviebrock\EloquentSluggable\Sluggable;

class InfluencerCategory extends BaseModel
{
    use Sluggable;

    protected $table = 'influencer_categories';

    protected $fillable = [
        'title',
        'slug',
        'details',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'title' => 'string',
        'slug' => 'string',
        'details' => 'string',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
