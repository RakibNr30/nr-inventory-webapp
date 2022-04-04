<?php

namespace Modules\Ums\Entities;

class Permission extends \Spatie\Permission\Models\Permission
{
    protected $table = 'permissions';

    protected $fillable = [
        'name',
		'description',
		'guard_name',
		'module_id',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'name' => 'string',
		'description' => 'string',
		'guard_name' => 'string',
		'module_id' => 'integer',
    ];
}
