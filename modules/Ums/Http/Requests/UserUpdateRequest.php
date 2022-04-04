<?php

namespace Modules\Ums\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'first_name' => 'required',
            'username' => 'required',
            'avatar' => 'sometimes|image|max:1024',
            'email' => 'required',
            // 'password' => 'required|min:6|confirmed',
            'roles' => 'required|array|min:1',
        ];
    }
}
