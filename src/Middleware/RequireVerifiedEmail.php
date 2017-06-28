<?php

namespace KilroyWeb\EmailVerification\Middleware;

use Closure;

class RequireVerifiedEmail
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
        if(!\Auth::user() || !\Auth::user()->emailIsVerified()){
            return redirect('/account');
        }
        return $next($request);
    }
}
