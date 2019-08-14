<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!\Auth::check() || !\Auth::check() || !\Auth::user()->hasAnyRole(['admin', 'super-admin', 'moderator'])) {
            return abort(404);
        }
        return $next($request);
    }
}
