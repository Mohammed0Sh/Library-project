<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class User_Is_Active
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
        if (Auth::user() && Auth::user()->user_state_id == 1)
        {
            return $next($request);
        }
        //return redirect('user/error/notActive');
        return back()->with('error_alert','حسابك لم يتم تنشيطه من قبل الإدارة بعد');
    }
}
