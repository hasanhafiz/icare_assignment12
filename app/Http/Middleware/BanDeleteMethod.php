<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BanDeleteMethod
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        // Test for the delete method
        if ( $request->method() === 'DELETE' ) {
            abort(403);
            // return response('Get out of here with that delete method', 405);
        }
        
        $response = $next($request);

        // Assign cookie
        $response->cookie('visited-our-site', TRUE);
        
        // return response
        return $response;
        // dd('You just hit BanDeleteMethod Middleware');
        // return $next($request);
    }
}
