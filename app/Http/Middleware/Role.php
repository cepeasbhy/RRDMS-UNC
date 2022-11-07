<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if(Auth::check()){
            if(Auth::user()->account_role == $role){
                return $next($request);
            }elseif($role == 'staff'){
                if(Auth::user()->account_role == 'rec_assoc' || Auth::user()->account_role == 'cic'){
                    return $next($request);
                }else{
                    return redirect()->back();
                }
            }else{
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }
        
    }
}
