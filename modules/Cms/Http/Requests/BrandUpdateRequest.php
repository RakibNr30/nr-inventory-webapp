<?php

namespace Modules\Cms\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Ums\Entities\User;

class BrandUpdateRequest extends FormRequest
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
        $id = request()->route()->parameters()[request()->route()->parameterNames[0]];

        $user = User::query()->find($id);

        return [
            'brand_name' => 'required|max:255',
            'avatar' => 'sometimes|image|max:1024',
            'reporting_tool_link' => 'required|max:255',
            'brand_priority' => "required|max:99999999",
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'zip_code' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country_code' => 'required|string|max:255',
            'business_email' => 'required|string|email|max:255',
            'mobile' => 'required|string|max:255',
            'vat_number' => 'required|string|max:255',
            'registration_number' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id ?? '',
        ];
    }
}
