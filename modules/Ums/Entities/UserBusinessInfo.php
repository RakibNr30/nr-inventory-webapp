<?php

namespace Modules\Ums\Entities;

use App\BaseModel;

class UserBusinessInfo extends BaseModel
{
    protected $table = 'user_business_infos';

    protected $fillable = [
        'name',
		'address',
		'zip_code',
		'city',
		'country_code',
		'email',
		'phone',
		'vat_number',
		'registration_number',
		'user_id',
    ];

    protected $hidden = [];

    protected $casts = [
        'name' => 'string',
		'address' => 'string',
		'zip_code' => 'string',
		'city' => 'string',
		'country_code' => 'string',
		'email' => 'string',
		'phone' => 'string',
		'vat_number' => 'string',
		'registration_number' => 'string',
		'user_id' => 'integer',
    ];


}
