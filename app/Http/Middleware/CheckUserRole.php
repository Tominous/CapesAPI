<?php

namespace CapesAPI\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
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
        if($request->user()) {
            if($request->user()->hasRole('banned') && $request->path() !== 'banned')
                return redirect()->route('banned');

            if($request->user()->hasRole('unverified') && $request->path() !== 'unverified')
                return redirect()->route('unverified');
        }

        return $next($request);
    }
}
