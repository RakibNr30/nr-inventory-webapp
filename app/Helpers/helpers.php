<?php

use Illuminate\Support\Facades\Auth;

// check if responder helper function doesn't exists
if (!function_exists('responder')) {
    // responder function
    function responder()
    {
        return new \App\Helpers\Responder\ResponseBuilder();
    }
}

// check if notifier helper function doesn't exists
if (!function_exists('notifier')) {
    // notifier function
    function notifier()
    {
        return new \App\Helpers\Notifier\Notifier();
    }
}
