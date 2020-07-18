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

        $response->header("Content-Security-Policy-Report-Only", "'default-src 'none'; form-action 'none'; frame-ancestors 'none'; report-uri https://{subdomain}.report-uri.com/r/d/csp/wizard ");

        return $response;
    }
}
