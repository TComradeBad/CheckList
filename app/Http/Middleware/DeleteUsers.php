<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class DeleteUsers
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
        if (!\Auth::check() || !Auth::user()->can("delete users")) {
            return abort(404);
        }
        return $next($request);
    }
}
