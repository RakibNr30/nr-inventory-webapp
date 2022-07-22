<?php

namespace Modules\Cms\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampaignStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'logo' => 'sometimes|image|max:1024',
            'brand_id' => 'required',
            'start_date' => 'required|max:20',
            'first_content_online' => 'required|max:20',
            'cycle_count' => 'required|numeric',
            'cycle_time_unit' => 'required|numeric',
            'product_ids' => 'array|min:0',
            'target_influencer_category_ids' => 'array',
            'target_influencer_genders' => 'array',
            'target_influencer_lower_age' => 'numeric|max:200',
            'target_influencer_upper_age' => 'numeric|max:200',
            'target_influencer_details' => 'max:4294967295',
            'amount_of_influencer_per_cycle' => 'numeric',
            'amount_of_influencer_follower_per_cycle' => 'numeric',
            'extra_agreements' => 'max:4294967295',
            'desired_content_notes' => 'max:4294967295',
            'instagram_story' => 'sometimes',
            'instagram_feed' => 'sometimes',
            'instagram_reel' => 'sometimes',
            'instagram_igtv' => 'sometimes',
            'tiktok_video' => 'sometimes',
            'extra_content_1' => 'sometimes|max:255',
            'extra_content_1_value' => 'sometimes',
            'extra_content_2' => 'sometimes|max:255',
            'extra_content_2_value' => 'sometimes',
            'extra_content_3' => 'sometimes|max:255',
            'extra_content_3_value' => 'sometimes',
            'extra_content_4' => 'sometimes|max:255',
            'extra_content_4_value' => 'sometimes',
            'extra_content_5' => 'sometimes|max:255',
            'extra_content_5_value' => 'sometimes',
            'briefing_pdf' => 'required|mimes:pdf',
            'additional_info' => 'required|max:4294967295',
            'personal_notes' => 'max:4294967295',
            'offer_signed' => 'required',
            'start_of_recurring_bill' => 'required|max:20',
            'billing_cycle_count' => 'required|numeric',
            'billing_cycle_time_unit' => 'required|numeric',
            'euros_total' => 'required|numeric',
        ];
    }
}
