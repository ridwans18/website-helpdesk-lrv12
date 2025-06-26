<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class LevelSatuOnly
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->level == 1) {
            return $next($request);
        }

        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
}
