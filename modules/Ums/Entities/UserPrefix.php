<?php

namespace Modules\Ums\Entities;

use App\BaseModel;

class UserPrefix extends BaseModel
{
    protected $table = 'user_prefixes';

    protected $fillable = [
        'prefix',
    ];

    protected $hidden = [];

    protected $casts = [
        'prefix' => 'string',
    ];
}
