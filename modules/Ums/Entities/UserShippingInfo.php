<?php

namespace Modules\Ums\Entities;

use App\BaseModel;

class UserShippingInfo extends BaseModel
{
    protected $table = 'user_shipping_infos';

    protected $fillable = [
        'phone',
		'first_name',
		'last_name',
		'address',
		'extra_info',
		'zip_code',
		'city',
		'country_code',
		'user_id',
    ];

    protected $hidden = [];

    protected $casts = [
        'phone' => 'string',
		'first_name' => 'string',
		'last_name' => 'string',
		'address' => 'string',
		'extra_info' => 'string',
		'zip_code' => 'string',
		'city' => 'string',
		'country_code' => 'string',
		'user_id' => 'integer',
    ];


}
