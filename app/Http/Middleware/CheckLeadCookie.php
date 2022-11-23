<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLeadCookie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        self::verificaCookieDoLead();
        return $next($request);
    }

    public static function verificaCookieDoLead()
    {
        if(! isset($_COOKIE['UUID_LEAD'])){
            setcookie('UUID_LEAD', \Illuminate\Support\Str::uuid()->toString(), time()+(86400*5));
        }
    }
}
