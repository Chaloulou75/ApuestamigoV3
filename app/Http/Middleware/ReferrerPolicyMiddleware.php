<?php

namespace App\Http\Middleware;

use Closure;

class ReferrerPolicyMiddleware
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

        $response->header('Referrer-Policy', 'no-referrer-when-downgrade');

        return $response;
    }
}
