<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class SetUsersChecklistsCount
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
        if (!Auth::user()->can('set users checklist count')) {
            return abort(404);
        }
        return $next($request);
    }
}
