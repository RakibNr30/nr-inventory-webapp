<?php

namespace Modules\Ums\Entities;

use Modules\Cms\Entities\Product;
use Spatie\MediaLibrary\HasMedia\HasMedia;

class User extends \App\User implements hasMedia
{
    protected $table = 'users';
    protected $guard_name = 'web';

    public function additionalInfo()
    {
        return $this->hasOne(UserAdditionalInfo::class, 'user_id', 'id');
    }

    public function shippingInfo()
    {
        return $this->hasOne(UserShippingInfo::class, 'user_id', 'id');
    }

    public function businessInfo()
    {
        return $this->hasOne(UserBusinessInfo::class, 'user_id', 'id');
    }

    public function socialAccountInfo()
    {
        return $this->hasOne(UserSocialAccountInfo::class, 'user_id', 'id');
    }

    public function languages()
    {
        return $this->hasMany(UserLanguage::class, 'user_id', 'id')->orderByDesc('created_at');
    }

    public function socialAccount()
    {
        return $this->hasMany(UserSocialAccountInfo::class, 'user_id', 'id')->orderByDesc('created_at');
    }

    public function products () {
        return $this->hasMany(Product::class, 'brand_id', 'id');
    }

    // get avatar attribute
    public function getAvatarAttribute()
    {
        $media = $this->getMedia(config('core.media_collection.user.avatar'));
        if (isset($media[0])) {
            return json_decode(json_encode([
                'file_name' => $media[0]->file_name,
                'file_url' => $media[0]->getUrl()
            ]));
        }
        return null;
    }

    public function uploadFiles()
    {
        // check for avatar
        if (request()->hasFile('avatar')) {
            // remove old file from collection
            if ($this->hasMedia(config('core.media_collection.user.avatar'))) {
                $this->clearMediaCollection(config('core.media_collection.user.avatar'));
            }
            // upload new file to collection
            $this->addMediaFromRequest('avatar')
                ->toMediaCollection(config('core.media_collection.user.avatar'));
        }
    }

    protected $format = 'Y-m-d';

    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format($this->format);
    }

    public function getUpdatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format($this->format);
    }
}
