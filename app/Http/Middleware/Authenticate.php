<?php

namespace App\Http\Middleware;
use View;
use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    public function __construct()
    {
        $userRole = "Unknown User";

        if (auth::check())
        {
            switch (session()->get('user_role')){
                case "customer":
                    $userRole = "Customer";
                    break;

                case "admin":
                    $userRole = "Administrator";
                    break;

                case "event-planner":
                    $userRole = "Event Planner";
                    break;

                case "team-member":
                    $userRole = "Team Member";
                    break;

                default:
                    switch (Auth::User()->role){
                        case "customer":
                            $userRole = "Customer";
                            break;

                        case "admin":
                            $userRole = "Administrator";
                            break;

                        case "event-planner":
                            $userRole = "Event Planner";
                            break;

                        case "team-member":
                            $userRole = "Team Member";
                            break;

                        default:
                            $userRole = "Unknown User";
                    }
            }
        }
        else{
            return redirect()->guest('login');
        }

        View::share('userRole', $userRole);
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }

        return $next($request);
    }
}
