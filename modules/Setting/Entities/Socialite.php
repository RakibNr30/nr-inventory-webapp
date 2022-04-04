<?php

namespace Modules\Setting\Entities;

use App\BaseModel;

class Socialite extends BaseModel
{
    protected $table = 'socialites';

    protected $fillable = [
        'google_key',
		'google_secret',
		'facebook_key',
		'facebook_secret',
		'twitter_key',
		'twitter_secret',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'google_key' => 'string',
		'google_secret' => 'string',
		'facebook_key' => 'string',
		'facebook_secret' => 'string',
		'twitter_key' => 'string',
		'twitter_secret' => 'string',
    ];


}
