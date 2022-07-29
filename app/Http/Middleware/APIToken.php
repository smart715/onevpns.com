<?php

namespace App\Http\Middleware;

use Closure;

class APIToken
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
        if($request->header('Auth')){

            return $next($request);
        }
        return response()->json([
            'result' => 'failure',
            'reponse' => 'Not a valid API request.',
        ]);
    }
}
