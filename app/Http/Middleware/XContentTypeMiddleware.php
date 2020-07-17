<?php

namespace App\Http\Middleware;

use Closure;

class XContentTypeMiddleware
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

        $response->header('X-Content-Type-Options', 'nosniff');

        return $response;
    }
}
