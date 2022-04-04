<?php

namespace Modules\Setting\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class SocialiteResource extends JsonResource
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
            'google_key' => $this->google_key,
			'google_secret' => $this->google_secret,
			'facebook_key' => $this->facebook_key,
			'facebook_secret' => $this->facebook_secret,
			'twitter_key' => $this->twitter_key,
			'twitter_secret' => $this->twitter_secret,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y')
        ];
    }
}
