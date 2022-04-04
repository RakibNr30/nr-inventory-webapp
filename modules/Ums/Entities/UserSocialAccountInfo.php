<?php

namespace Modules\Ums\Entities;

use App\BaseModel;

class UserSocialAccountInfo extends BaseModel
{
    protected $table = 'user_social_account_infos';

    protected $fillable = [
        'instagram_username',
        'instagram_followers',
        'tiktok_username',
        'tiktok_followers',
        'user_id',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'instagram_username' => 'string',
        'instagram_followers' => 'integer',
        'tiktok_username' => 'string',
        'tiktok_followers' => 'integer',
        'user_id' => 'integer',
    ];

   /* public function socialSites () {
        return $this->hasMany(SocialSite::class, 'id', 'social_site_id');
    }*/
}
