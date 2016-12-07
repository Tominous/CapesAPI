<?php

namespace CapesAPI\Http\Middleware;

use Closure;
use Projects;
use User;
use Auth;

class IsProjectOwner
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
        $project = Projects::where('hash', $request->hash)->first();
        $userId = Auth::user()->id;

        if($userId != $project->developer_id) {
            return abort(403);
        }
        

        return $next($request);
    }
}
