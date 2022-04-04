<?php

namespace Modules\Setting\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactStoreRequest extends FormRequest
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
            'email' => 'sometimes|email',
			'phone' => 'sometimes|max:255',
			'mobile' => 'sometimes|max:255',
			'fax' => 'sometimes|max:255',
			'website' => 'sometimes|max:255',
			'address' => 'sometimes|max:255',
			'google_map' => 'sometimes|max:255',
			'longitude' => 'sometimes|max:255',
			'latitude' => 'sometimes|max:255',
			'facebook' => 'sometimes|max:255',
			'twitter' => 'sometimes|max:255',
			'linked_in' => 'sometimes|max:255',
			'youtube' => 'sometimes|max:255',
			'instagram' => 'sometimes|max:255',
			'skype' => 'sometimes|max:255',
			'whatsapp' => 'sometimes|max:255',
        ];
    }
}
