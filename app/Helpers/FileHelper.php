<?php

namespace App\Helpers;

class FileHelper
{
    public static function getType ($mimeType): string
    {
        $fileTypes = [
            'ai' => 'image',
            'bmp' => 'image',
            'git' => 'image',
            'ico' => 'image',
            'jpeg' => 'image',
            'jpg' => 'image',
            'png' => 'image',
            'ps' => 'image',
            'psd' => 'image',
            'svg' => 'image',
            'tif' => 'image',
            'tiff' => 'image',
            'webp' => 'image',
            '3g2' => 'video',
            '3gp' => 'video',
            'avi' => 'video',
            'flv' => 'video',
            'h264' => 'video',
            'm4v' => 'video',
            'mkv' => 'video',
            'mov' => 'video',
            'mp4' => 'video',
            'mpg' => 'video',
            'mpeg' => 'video',
            'rm' => 'video',
            'swf' => 'video',
            'vob' => 'video',
            'wmv' => 'video'
        ];

        $fileType = substr($mimeType, strpos($mimeType, "/") + 1, strlen($mimeType));

        return $fileTypes[$fileType] ?? '';
    }
}
