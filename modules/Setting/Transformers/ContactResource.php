<?php

namespace Modules\Setting\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
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
            'email' => $this->email,
			'phone' => $this->phone,
			'mobile' => $this->mobile,
			'fax' => $this->fax,
			'website' => $this->website,
			'address' => $this->address,
			'google_map' => $this->google_map,
			'longitude' => $this->longitude,
			'latitude' => $this->latitude,
			'facebook' => $this->facebook,
			'twitter' => $this->twitter,
			'linked_in' => $this->linked_in,
			'youtube' => $this->youtube,
			'instagram' => $this->instagram,
			'skype' => $this->skype,
			'whatsapp' => $this->whatsapp,
			'working_hours' => $this->working_hours,
			'working_days' => $this->working_days,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y')
        ];
    }
}
