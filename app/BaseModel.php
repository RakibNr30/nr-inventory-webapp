<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
	//private $format = 'Y-m-d';
	private $format = 'M d, Y';
	private $format2 = 'M d, Y, h:i A';

    public function getCreatedAtAttribute($value)
    {
    	return \Carbon\Carbon::parse($value)->format($this->format);
    }

    public function getUpdatedAtAttribute($value)
    {
    	return \Carbon\Carbon::parse($value)->format($this->format);
    }

    public function getApprovedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format($this->format);
    }

    public function getStartDateAttribute($value)
    {
    	return \Carbon\Carbon::parse($value)->format($this->format);
    }

    public function getEndDateAttribute($value)
    {
    	return \Carbon\Carbon::parse($value)->format($this->format);
    }

    public function getDisplayDateAttribute($value)
    {
    	return \Carbon\Carbon::parse($value)->format($this->format);
    }

    public function getDobAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format($this->format);
    }

    public function getFirstContentOnlineAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format($this->format);
    }

    public function getStartOfRecurringBillAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format($this->format);
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function($model)
        {
            $userId = auth()->user()->id ?? null;
            $model->created_by = $userId;
            $model->updated_by = $userId;
        });
    }
}
