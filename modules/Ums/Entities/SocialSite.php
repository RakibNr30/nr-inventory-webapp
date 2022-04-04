<?php

namespace Modules\Ums\Entities;

use App\BaseModel;

class SocialSite extends BaseModel
{
    protected $table = 'social_sites';

    protected $fillable = [
        'title',
		'icon',
		'link',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'title' => 'string',
		'icon' => 'string',
		'link' => 'string',
    ];


}
