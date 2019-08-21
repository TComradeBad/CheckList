<?php

namespace App\Http\Middleware\API;

use Closure;

class CheckListCount
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
        if($request->user()->checkLists()->count() >= $request->user()->max_check_lists_count){
            return response(null,406);
        }
        return $next($request);
    }
}
