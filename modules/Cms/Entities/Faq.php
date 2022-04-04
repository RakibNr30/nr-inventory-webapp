<?php

namespace Modules\Cms\Entities;

use App\BaseModel;

class Faq extends BaseModel
{
    protected $table = 'faqs';

    protected $fillable = [
        'question',
		'answer',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'question' => 'string',
		'answer' => 'string',
    ];


}
