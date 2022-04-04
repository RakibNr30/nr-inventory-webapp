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
    public function getAvailableUntilAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format($this->format2);
    }
}
