<?php

namespace Modules\Ums\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InfluencerStoreRequest extends FormRequest
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
            'instagram_username' => 'required|max:255|unique:user_social_account_infos',
            'instagram_followers' => 'required|numeric',
            'tiktok_username' => 'max:255|unique:user_social_account_infos',
            'tiktok_followers' => 'numeric',
            'first_name' => 'required|max:30',
            'last_name' => 'required|max:30',
            'phone' => 'required|max:15',
            'gender' => 'required',

            'shipping_first_name' => 'required|max:30',
            'shipping_last_name' => 'required|max:30',
            'address' => 'required|max:255',
            'extra_info' => 'required|max:255',
            'zip_code' => 'required|max:20',
            'city' => 'required|max:100',
            'country_code' => 'required|max:20',

            'avatar' => 'sometimes|image|max:1024',
			'email' => 'required|unique:users',
			'password' => 'required|min:6|confirmed',
        ];
    }
}
