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

    // if (isset($_SERVER['HTTP_ORIGIN'])) {
    //     // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
    //     // you want to allow, and if so:
    //     header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    //     header('Access-Control-Allow-Credentials: true');
    //     header('Access-Control-Max-Age: 86400');    // cache for 1 day
    // }

    // // Access-Control headers are received during OPTIONS requests
    // if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    //     if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
    //         // may also be using PUT, PATCH, HEAD etc
    //         header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

    //     if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
    //         header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    //     exit(0);
    // }

    // echo "You have CORS!";

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
