<?php

namespace Modules\Ums\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Ums\Entities\User;

class UserRegistrationRequest extends FormRequest
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
        $user = User::query()->findOrFail($this->user_id);

        if ($user->hasRole("Influencer")) {
            return [
                'instagram_username' => 'required|max:255',
                'tiktok_username' => 'max:255',
                'phone' => 'required|max:15',
                'first_name' => 'required|max:30',
                'last_name' => 'required|max:30',
                'address' => 'required|max:255',
                'extra_info' => 'required|max:255',
                'zip_code' => 'required|max:20',
                'city' => 'required|max:100',
                'country_code' => 'required|max:20'
            ];
        }
        else {
            return [
                'name' => 'required|max:60',
                'address' => 'required|max:255',
                'zip_code' => 'required|max:20',
                'city' => 'required|max:100',
                'country_code' => 'required|max:20',
                'email' => 'required|max:255',
                'phone' => 'required|max:15',
                'vat_number' => 'required|max:50',
                'registration_number' => 'required|max:50',
            ];
        }
    }
}
