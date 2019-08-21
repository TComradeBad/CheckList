<?php

namespace App\Http\Middleware\API;

use Closure;

class CheckListItemsCount
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
        $data = $request->json()->all();
        if(count($data["items"]) > $request->user()->max_check_list_items_count){
            return response(null,406);
        }
        return $next($request);

    }
}
