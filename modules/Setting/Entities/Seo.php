<?php

namespace Modules\Setting\Entities;

use App\BaseModel;

class Seo extends BaseModel
{
    protected $table = 'seos';

    protected $fillable = [
        'meta_title',
		'meta_description',
		'meta_type',
		'meta_tags',
		'canonical',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'meta_title' => 'string',
		'meta_description' => 'string',
		'meta_type' => 'string',
		'meta_tags' => 'string',
		'canonical' => 'string',
    ];


}
