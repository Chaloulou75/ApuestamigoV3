<?php

namespace App\Http\Middleware;

use Closure;

class CspMiddleware
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

        $response->header('Content-Security-Policy', "default-src 'self'; style-src 'self' 'unsafe-inline' fonts.googleapis.com data:; font-src fonts.googleapis.com fonts.gstatic.com 'self' ; script-src 'self' 'unsafe-inline' 'unsafe-eval' *.googletagmanager.com https://js.stripe.com/ ; img-src *.amazonaws.com 'self'; frame-src https://js.stripe.com/; form-action 'self';");//-Report-Only

        return $response;
    }
}
