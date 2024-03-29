<?php

namespace Modules\Ums\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
			'email_verified_at' => $this->email_verified_at,
			'is_brand' => $this->is_brand,
			'user_brand_id' => $this->user_brand_id,
			'profile_grade' => $this->profile_grade,
			'approved_at' => $this->approved_at,
			'approved_by' => $this->approved_by,
            'created_at' => $this->created_at->format('Y-m-d'),
            'updated_at' => $this->updated_at->format('Y-m-d')
        ];
    }
}
