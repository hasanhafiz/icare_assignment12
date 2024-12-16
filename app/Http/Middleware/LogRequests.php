<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Log the incoming request
        Log::info("Request URL:", ['url' => $request->fullUrl() ] );
        Log::info("Request Data:", ['data' => $request->all()]);
        
        // Pass the request to next middleware / controller
        return $next($request);
    }
}
