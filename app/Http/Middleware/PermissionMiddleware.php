<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

// models
use Modules\Ums\Entities\User;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        $user = User::find(Auth::user()->id);
        try {
            if ($user->hasPermissionTo($permission)) {
                return $next($request);
            }
            return redirect()->to('/backend/dashboard');
        } catch (\Exception $exception) {
            return redirect()->to('/backend/dashboard');
        }
    }
}
