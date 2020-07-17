<?php

namespace App\Http\Middleware;

use Closure;

class StrictTransportSecurityMiddleware
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
        $response = $next($request);

        $response->header('Strict-Transport-Security', 'max-age=63072000; includeSubDomains');

        return $response;
    }
}
