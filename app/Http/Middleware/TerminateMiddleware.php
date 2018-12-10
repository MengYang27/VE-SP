<?php

namespace App\Http\Middleware;

use Closure;

class TerminateMiddleware
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
        echo "<br /> terminate: handle() invoked.";
        return $next($request);
    }

    public function terminate ($request, $response){
        echo "<br /> terminate: terminate() invoked.";
    }
}
