<?php

namespace Modules\Cms\Entities;

use App\BaseModel;
use Modules\Ums\Entities\User;

class CampaignInfluencer extends BaseModel
{
    protected $table = 'campaign_influencers';

    protected $fillable = [
        'campaign_id',
        'influencer_id',
		'brand_ids',
		'available_until',
		'content_types',
		'fee',
		'cycle_count',
		'start_date',
		'personal_notes',
		'accept_status',
		'is_add_to_favourite',
		'is_reported',
		'report_details',
		'individual_coupon_code',
		'individual_swipe_up_link',
		'shipping_address',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'campaign_id' => 'integer',
        'influencer_id' => 'integer',
        'brand_ids' => 'array',
        'available_until' => 'datetime',
        'content_types' => 'array',
        'fee' => 'double',
        'cycle_count' => 'integer',
        'start_date' => 'datetime',
        'personal_notes' => 'string',
        'accept_status' => 'integer',
        'is_add_to_favourite' => 'integer',
        'is_reported' => 'integer',
        'report_details' => 'string',
        'individual_coupon_code' => 'string',
        'individual_swipe_up_link' => 'string',
        'shipping_address' => 'string',
    ];

    public function user() {
        return $this->hasOne(User::class, 'id', 'influencer_id');
    }
    public function campaign() {
        return $this->hasOne(Campaign::class, 'id', 'campaign_id');
    }
}
