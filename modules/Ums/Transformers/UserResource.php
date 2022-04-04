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
            'username' => $this->username,
			'phone' => $this->phone,
			'email' => $this->email,
			'password' => $this->password,
			'email_verified_at' => $this->email_verified_at,
			'remember_token' => $this->remember_token,
			'approved_at' => $this->approved_at,
			'approved_by' => $this->approved_by,
            'created_at' => $this->created_at->format('Y-m-d'),
            'updated_at' => $this->updated_at->format('Y-m-d')
        ];
    }
}
