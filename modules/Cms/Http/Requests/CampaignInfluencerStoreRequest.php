<?php

namespace Modules\Cms\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampaignInfluencerStoreRequest extends FormRequest
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
            'influencer_id' => 'required',
            //'brand_ids' => 'required|min:1',
            'available_until' => 'required',
            'content_types' => 'required|min:1',
            'fee' => 'required|numeric',
            'cycle_count' => 'required|numeric',
            'start_date' => 'required',
            'personal_notes' => 'max:4294967295',
        ];
    }
}
