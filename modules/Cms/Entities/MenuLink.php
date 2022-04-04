<?php

namespace Modules\Cms\Entities;

use App\BaseModel;
use Cviebrock\EloquentSluggable\Sluggable;

class MenuLink extends BaseModel
{
    use Sluggable;

    protected $table = 'menu_links';

    protected $fillable = [
        'title',
        'slug',
		'description',
		'url',
		'link_type',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'title' => 'string',
        'slug' => 'string',
		'description' => 'string',
		'url' => 'string',
		'link_type' => 'string',
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
