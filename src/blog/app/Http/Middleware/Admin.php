<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

function p($item)
{
    Log::debug($item);
}

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $path = (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
        
        if (empty($request->user())){
            session(["url.intended"=>$path]);
            return redirect("/login");
        }

        if ($request->user()->role=='admin'){
            return $next($request);
        }else{
            session(["url.intended"=>$path]);
            return redirect("/login");
        }
    }
}
