<?php

namespace App\Http\Middleware;

use App\Helpers\AuthManager;
use Closure;
use Modules\Ums\Entities\User;

class RegisterCompleted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()) {
            if (!AuthManager::isVerified(auth()->user()) &&
                (AuthManager::isInfluencer() || AuthManager::isBrand())
            ) {
                auth()->logout();
                return redirect()->route('verification.notice');
            }

            if (!AuthManager::isProcessCompleted(auth()->user()) &&
                (AuthManager::isInfluencer() || AuthManager::isBrand())
            ) {
                session(['user_id' => auth()->user()->id]);
                auth()->logout();
                return redirect()->route('register.almost-ready');
            }
        }

        return $next($request);
    }
}
