<?php

namespace Modules\Ums\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class UserShippingInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'phone' => $this->phone,
			'first_name' => $this->first_name,
			'last_name' => $this->last_name,
			'address' => $this->address,
			'extra_info' => $this->extra_info,
			'zip_code' => $this->zip_code,
			'city' => $this->city,
			'country_code' => $this->country_code,
			'user_id' => $this->user_id,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y')
        ];
    }
}
