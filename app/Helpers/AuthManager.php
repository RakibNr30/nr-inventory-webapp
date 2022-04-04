<?php

namespace App\Helpers;

use Modules\Ums\Entities\User;

class AuthManager
{
    public static function isSuperAdmin() {
        $user = User::query()->findOrFail(auth()->user()->id);

        if ($user->hasRole('Super Admin')) return true;
        return false;
    }

    public static function isAdmin() {
        $user = User::query()->findOrFail(auth()->user()->id);

        if ($user->hasRole('Admin')) return true;
        return false;
    }

    public static function isInfluencer() {
        $user = User::query()->findOrFail(auth()->user()->id);

        if ($user->hasRole('Influencer')) return true;
        return false;
    }

    public static function isProcessCompleted($user) {
        return $user->is_process_completed ?? null;
    }
}
