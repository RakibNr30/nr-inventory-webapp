<?php


namespace App\Helpers;


class SmsManager
{
    public static function sendSms($to, $text) {
        $to = str_replace('+', '', $to);
        $apiUrl = config('core.sms_api');
        $apiUrl = str_replace('[TO]', $to, $apiUrl);
        $apiUrl = str_replace('[TEXT]', urlencode($text), $apiUrl);

        file_get_contents($apiUrl);
    }
}