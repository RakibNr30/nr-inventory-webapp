<?php

namespace Modules\Ums\Entities;

use App\BaseModel;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class UserAdditionalInfo extends BaseModel implements HasMedia
{
    use HasMediaTrait;

    protected $table = 'user_additional_infos';

    protected $fillable = [
        'first_name',
		'last_name',
        'designation',
        'about',
		'dob',
        'gender',
		'blood_group',
		'user_id',
    ];

    protected $hidden = [

    ];

    protected $appends = ['image'];

    protected $casts = [
        'first_name' => 'string',
		'last_name' => 'string',
		'designation' => 'string',
		'about' => 'string',
		'dob' => 'timestamp',
        'gender' => 'string',
		'blood_group' => 'string',
		'user_id' => 'integer',
    ];

    public function getImageAttribute()
    {
        $media = $this->getMedia(config('core.media_collection.user_additional_info.image'));
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
        // check for image
        if (request()->hasFile('image')) {
            // remove old file from collection
            if ($this->hasMedia(config('core.media_collection.user_additional_info.image'))) {
                $this->clearMediaCollection(config('core.media_collection.user_additional_info.image'));
            }
            // upload new file to collection
            $this->addMediaFromRequest('image')
                ->toMediaCollection(config('core.media_collection.user_additional_info.image'));
        }
    }
}
