<?php

namespace Modules\Setting\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiteStoreRequest extends FormRequest
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
            'logo' => 'sometimes|image',
            'favicon' => 'sometimes|image',
            'banner_image' => 'sometimes|image',
            'parallax_image_1' => 'sometimes|image',
            'parallax_image_2' => 'sometimes|image',
            'parallax_image_3' => 'sometimes|image',
            'footer_image' => 'sometimes|image'
        ];
    }
}
