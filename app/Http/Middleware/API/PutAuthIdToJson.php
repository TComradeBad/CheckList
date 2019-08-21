<?php

namespace App\Http\Middleware\API;

use Closure;

class PutAuthIdToJson
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
        $request->json()->set("user_id",\Auth::user()->id);
        return $next($request);
    }
}
