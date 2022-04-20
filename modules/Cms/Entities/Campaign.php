<?php

namespace Modules\Cms\Entities;

use App\BaseModel;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\Tests\Models\PostWithMaxLengthSplitWords;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Ums\Entities\User;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Campaign extends BaseModel implements hasMedia
{
    use Sluggable, HasMediaTrait;

    protected $table = 'campaigns';

    protected $fillable = [
        'title',
		'slug',
		'brand_id',
		'start_date',
		'first_content_online',
		'cycle_count',
		'cycle_time_unit',
		'product_ids',
		'target_influencer_category_ids',
		'target_influencer_genders',
        'target_influencer_lower_age',
        'target_influencer_upper_age',
		'target_influencer_details',
		'amount_of_influencer_per_cycle',
		'amount_of_influencer_follower_per_cycle',
		'extra_agreements',
        'individual_coupon_code_internal',
        'individual_coupon_code_brand',
        'individual_swipe_up_link_internal',
        'individual_swipe_up_link_brand',
        'influencer_shipping_address_brand',
        'campaign_goals',
        'desired_content_notes',
        'personal_notes',
		'offer_signed',
		'start_of_recurring_bill',
		'billing_cycle_count',
		'billing_cycle_time_unit',
		'euros_total',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'title' => 'string',
		'slug' => 'string',
		'brand_id' => 'integer',
		'start_date' => 'datetime',
		'first_content_online' => 'datetime',
		'cycle_count' => 'integer',
		'cycle_time_unit' => 'integer',
		'product_ids' => 'array',
		'target_influencer_category_ids' => 'array',
		'target_influencer_genders' => 'array',
		'target_influencer_lower_age' => 'integer',
		'target_influencer_upper_age' => 'integer',
		'target_influencer_details' => 'string',
		'amount_of_influencer_per_cycle' => 'integer',
		'amount_of_influencer_follower_per_cycle' => 'integer',
		'extra_agreements' => 'string',
		'individual_coupon_code_internal' => 'integer',
		'individual_coupon_code_brand' => 'integer',
		'individual_swipe_up_link_internal' => 'integer',
		'individual_swipe_up_link_brand' => 'integer',
		'influencer_shipping_address_brand' => 'integer',
		'campaign_goals' => 'array',
		'desired_content_notes' => 'string',
		'personal_notes' => 'string',
		'offer_signed' => 'integer',
		'start_of_recurring_bill' => 'datetime',
		'billing_cycle_count' => 'integer',
		'billing_cycle_time_unit' => 'integer',
		'euros_total' => 'double',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getLogoAttribute()
    {
        $media = $this->getMedia(config('core.media_collection.campaign.logo') ?? '');
        if (isset($media[0])) {
            return json_decode(json_encode([
                'file_name' => $media[0]->file_name,
                'file_url' => $media[0]->getUrl()
            ]));
        }
        return null;
    }

    public function uploadFiles()
    {
        // check for logo
        if (request()->hasFile('logo')) {
            // remove old file from collection
            if ($this->hasMedia(config('core.media_collection.campaign.logo'))) {
                $this->clearMediaCollection(config('core.media_collection.campaign.logo'));
            }
            // upload new file to collection
            $this->addMediaFromRequest('logo')
                ->toMediaCollection(config('core.media_collection.campaign.logo'));
        }
    }

    public function campaignInfluencers() {
        return $this->hasMany(CampaignInfluencer::class, 'campaign_id', 'id');
    }

    public function brand() {
        return $this->hasOne(User::class, 'id', 'brand_id');
    }
}
