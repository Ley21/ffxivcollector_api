<?php

namespace App\Http\Middleware;

use Closure;

class BasicAuth
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
        if($_ENV['APP_USERNAME'] != $request->getUser() || 
            $_ENV['APP_PASSWORD'] != $request->getPassword()){
                $user = $request->getUser();
                $password = $request->getPassword();
                return response("Unauthorized. $user $password", 401);
        }
        return $next($request);
    }
}
