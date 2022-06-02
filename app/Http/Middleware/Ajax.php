<?php

namespace App\Http\Middleware;

use closure ;

class Ajax
{
    public function handle($request, closure $next)
    {
        if($request->ajax())
        {
            return $next($request);
        }
        abort(404);
    }
}
