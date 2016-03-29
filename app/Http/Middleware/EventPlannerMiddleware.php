<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class EventPlannerMiddleware
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
        if (Auth::check())
        {
            if ($request->user()->role != 'admin' & $request->user()->role != 'event-planner')
            {
                return response()->view('permission-denied');
            }
        }

        return $next($request);
    }
}
