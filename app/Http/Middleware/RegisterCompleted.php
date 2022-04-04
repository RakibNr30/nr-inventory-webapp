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
            if (!AuthManager::isProcessCompleted(auth()->user()) &&
                AuthManager::isInfluencer()
            ) {
                session(['user_id' => auth()->user()->id]);
                auth()->logout();
                return redirect()->route('register.almost-ready');
            }
        }

        return $next($request);
    }
}
