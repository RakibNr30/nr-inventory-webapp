<?php

namespace Modules\Ums\Entities;

use App\BaseModel;

class UserLanguage extends BaseModel
{
    protected $table = 'user_languages';

    protected $fillable = [
        'name',
		'description',
		'proficiency',
		'user_id',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'name' => 'string',
		'description' => 'string',
		'proficiency' => 'integer',
		'user_id' => 'integer',
    ];


}
