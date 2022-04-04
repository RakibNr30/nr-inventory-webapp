<?php

namespace Modules\Ums\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserSocialAccountInfoUpdateRequest extends FormRequest
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
            'instagram_username' => 'required|max:255',
            'instagram_followers' => 'numeric|min:0|max:18446744073709551615',
            'tiktok_username' => 'required|max:255',
        ];
    }
}
