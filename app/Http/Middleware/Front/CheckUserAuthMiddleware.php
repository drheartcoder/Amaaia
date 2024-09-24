<?php

namespace App\Http\Middleware\Front;

use Closure;

class CheckUserAuthMiddleware
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
        $this->auth = auth()->guard('user');

        if($this->auth->user())
        {
            return redirect(url('/users/dashboard')); 
        }
        return $next($request);
    }
}
