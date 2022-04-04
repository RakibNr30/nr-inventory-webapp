<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisitorLog extends Model
{
    protected $fillable = [
        'ip_address',
        'request_url',
        'device_type',
        'browser_type',
        'browser_name',
        'browser_family',
        'browser_version',
        'browser_engine',
        'os_type',
        'os_name',
        'os_family',
        'os_version',
        'device_family',
        'device_model',
        'device_grade',
        'visit_count',
    ];
}
