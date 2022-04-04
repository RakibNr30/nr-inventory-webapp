<?php

namespace Modules\Setting\Entities;

use App\BaseModel;

class Contact extends BaseModel
{
    protected $table = 'contacts';

    protected $fillable = [
        'email',
		'phone',
		'mobile',
		'fax',
		'website',
		'address',
		'google_map',
		'longitude',
		'latitude',
		'facebook',
		'twitter',
		'linked_in',
		'youtube',
		'instagram',
		'skype',
		'whatsapp',
		'working_hours',
		'working_days',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'email' => 'string',
		'phone' => 'string',
		'mobile' => 'string',
		'fax' => 'string',
		'website' => 'string',
		'address' => 'string',
		'google_map' => 'string',
		'longitude' => 'string',
		'latitude' => 'string',
		'facebook' => 'string',
		'twitter' => 'string',
		'linked_in' => 'string',
		'youtube' => 'string',
		'instagram' => 'string',
		'skype' => 'string',
		'whatsapp' => 'string',
		'working_hours' => 'string',
		'working_days' => 'string',
    ];
}
