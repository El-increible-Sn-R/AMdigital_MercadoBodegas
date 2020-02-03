<?php

namespace App\Http\Middleware;

use Closure;

class Cors
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
        return $next($request)
        ->header('Access-Control-Allow-Origin','*')
        ->header('Access-Control-Allow-Methods','*')
        ->header('Access-Control-Allow-Headers','Origin, X-Requested-With, Content-Type,Access,application/json')
        ->header('Access-Control-Allow-Credentials', 'true')
        ->header('Allow', 'GET, POST, OPTIONS, PUT, DELETE');
    }

    ///
    ///response.setHeader("Access-Control-Allow-Origin", "*");
    ///response.setHeader("Access-Control-Allow-Methods", "POST, PUT, GET, OPTIONS, DELETE");
    ///response.setHeader("Access-Control-Allow-Headers", "Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With,observe");
    ///response.setHeader("Access-Control-Max-Age", "3600");
    ///response.setHeader("Access-Control-Allow-Credentials", "true");
    ///response.setHeader("Access-Control-Expose-Headers", "Authorization");
    ///response.addHeader("Access-Control-Expose-Headers", "responseType");
    ///response.addHeader("Access-Control-Expose-Headers", "observe");
    ///System.out.println("Request Method: "+request.getMethod());
    ///if (!(request.getMethod().equalsIgnoreCase("OPTIONS"))) 
    ///
}
