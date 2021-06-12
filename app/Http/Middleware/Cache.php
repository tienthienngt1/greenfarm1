<?php

namespace App\Http\Middleware;

use Closure;
use App\Cache\CacheController;
use Illuminate\Http\Request;

class Cache
{
    use CacheController;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (\Auth::check()) {
            $this->usersCache();
        }
        return $next($request);
    }
}
