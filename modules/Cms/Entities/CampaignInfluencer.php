<?php

namespace Modules\Cms\Entities;

use App\BaseModel;
use Carbon\Carbon;
use Modules\Ums\Entities\User;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class CampaignInfluencer extends BaseModel implements HasMedia
{

    use HasMediaTrait;

    protected $table = 'campaign_influencers';

    protected $fillable = [
        'campaign_id',
        'influencer_id',
		'brand_ids',
		'denied_brand_ids',
		'brand_denied_reasons',
		'available_until',
		'content_types',
		'fee',
		'cycle_count',
		'start_date',
		'personal_notes',
		'accept_status',
		'campaign_accept_status_by_influencer',
		'denied_reason',
		'is_add_to_favourite',
		'is_reported',
		'report_details',
		'individual_coupon_code',
		'individual_swipe_up_link',
        'internal_individual_coupon_code',
		'internal_individual_swipe_up_link',
		'shipping_address',
		'feedback',
		'is_content_uploaded',
		'admin_is_content_uploaded',
		'briefing_reminder',
		'briefing_reminders_at',
		'content_reminder',
		'content_reminders_at',
		'missing_content_reminder',
		'missing_content_reminders_at',
		'campaign_manager_id',
		'is_pre_selected',
		'is_brand_campaign',
		'parent_campaign_influencer_id',
		'base_campaign_influencer_ids',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'campaign_id' => 'integer',
        'influencer_id' => 'integer',
        'brand_ids' => 'array',
        'denied_brand_ids' => 'array',
        'brand_denied_reasons' => 'array',
        'available_until' => 'datetime',
        'content_types' => 'array',
        'fee' => 'double',
        'cycle_count' => 'integer',
        'start_date' => 'datetime',
        'personal_notes' => 'string',
        'accept_status' => 'integer',
        'campaign_accept_status_by_influencer' => 'integer',
        'denied_reason' => 'string',
        'is_add_to_favourite' => 'integer',
        'is_reported' => 'integer',
        'report_details' => 'string',
        'individual_coupon_code' => 'string',
        'individual_swipe_up_link' => 'string',
        'internal_individual_coupon_code' => 'string',
        'internal_individual_swipe_up_link' => 'string',
        'shipping_address' => 'string',
        'feedback' => 'array',
        'is_content_uploaded' => 'integer',
        'admin_is_content_uploaded' => 'integer',
        'briefing_reminder' => 'integer',
        'briefing_reminders_at' => 'array',
        'content_reminder' => 'integer',
        'content_reminders_at' => 'array',
        'missing_content_reminder' => 'integer',
        'missing_content_reminders_at' => 'array',
        'campaign_manager_id' => 'integer',
        'is_pre_selected' => 'integer',
        'is_brand_campaign' => 'integer',
        'parent_campaign_influencer_id' => 'integer',
        'base_campaign_influencer_ids' => 'array',
    ];

    public function user() {
        return $this->hasOne(User::class, 'id', 'influencer_id');
    }

    public function campaign() {
        return $this->hasOne(Campaign::class, 'id', 'campaign_id');
    }

    public function getBrandsAttribute()
    {
        return User::query()->whereIn('id', $this->brand_ids)->get();
    }

    public function getCurrentCycleAttribute()
    {
        $campaign = $this->campaign;
        $current_cycle = 1;
        if ($campaign->cycle_time_unit == 1) {
            $current_cycle = Carbon::parse($this->start_date)->diffInMonths() + 1;
        }
        if ($campaign->cycle_time_unit == 2) {
            $current_cycle = Carbon::parse($this->start_date)->diffInWeeks() + 1;
        }

        return $current_cycle;
    }

    public function getNextDeadlineAttribute()
    {
        $campaign = $this->campaign;
        $next_deadline = null;
        if ($campaign->cycle_time_unit == 1) {
            $current_cycle = Carbon::parse($this->start_date)->diffInMonths() + 1;
            $next_deadline = Carbon::parse($this->start_date)->addMonths($current_cycle);
        }
        if ($campaign->cycle_time_unit == 2) {
            $current_cycle = Carbon::parse($this->start_date)->diffInWeeks() + 1;
            $next_deadline = Carbon::parse($this->start_date)->addWeeks($current_cycle);
        }

        return $next_deadline;
    }

    public function getBaseCampaignInfluencersAttribute()
    {
        return CampaignInfluencer::query()->whereIn('id', $this->base_campaign_influencer_ids)->get();
    }
}
