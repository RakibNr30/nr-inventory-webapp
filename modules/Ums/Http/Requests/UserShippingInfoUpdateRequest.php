<?php

namespace Modules\Ums\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserShippingInfoUpdateRequest extends FormRequest
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
            /*'present_country' => 'required',
            'present_city' => 'required',
            'present_state' => 'required',
            'permanent_country' => 'required',
            'permanent_city' => 'required',
            'permanent_state' => 'required'*/
        ];
    }
}
