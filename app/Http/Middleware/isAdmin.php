<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class isAdmin
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

        if (Auth::user() && Auth::user()->getRole->id == 1)
        {
            return $next($request);
        }
        //return redirect('user/error/notAdmin');
        return back()->with('error_alert','حسابك لا يتمتع بصلاحيات الدخول لهذا الرابط');
    }
}
