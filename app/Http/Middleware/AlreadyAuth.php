<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
class AlreadyAuth
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
        if($user=Sentinel::check()){
            return redirect("/admin/dashboard");
        }
        return $next($request);
    }
}
