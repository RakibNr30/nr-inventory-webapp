<?php

namespace Modules\Setting\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SocialiteUpdateRequest extends FormRequest
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
            'google_key' => 'required|max:255',
			'google_secret' => 'required|max:255',
			'facebook_key' => 'required|max:255',
			'facebook_secret' => 'required|max:255',
			'twitter_key' => 'required|max:255',
			'twitter_secret' => 'required|max:255',
        ];
    }
}
