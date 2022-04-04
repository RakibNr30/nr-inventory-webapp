<?php

namespace Modules\Cms\Entities;

use App\BaseModel;
use Cviebrock\EloquentSluggable\Sluggable;

class Menu extends BaseModel
{
    use Sluggable;

    protected $table = 'menus';

    protected $fillable = [
        'title',
        'slug',
		'description',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'title' => 'string',
        'slug' => 'string',
		'description' => 'string',
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
