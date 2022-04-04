<?php

namespace App\Helpers\Notifier;

use Illuminate\Support\Facades\Session;

class Notifier
{
    public function success($message, $title = 'Success!')
    {
        Session::flash('alert.status', 'success');
        Session::flash('alert.icon', 'fa-check');
        Session::flash('alert.title', $title);
        Session::flash('alert.body', $message);
    }

    public function error($message, $title = 'Error!')
    {
        Session::flash('alert.status', 'danger');
        Session::flash('alert.icon', 'fa-ban');
        Session::flash('alert.title', $title);
        Session::flash('alert.body', $message);
    }

    public function warning($message, $title = 'Warning!')
    {
        Session::flash('alert.status', 'warning');
        Session::flash('alert.icon', 'fa-exclamation-triangle');
        Session::flash('alert.title', $title);
        Session::flash('alert.body', $message);
    }
}
