<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()==null){
            if(Auth::guard('project_leads')->user()==null){
                if(Auth::guard('supervisor')->user()==null){
                    return redirect()->to('/');
                }

                else {
                    return $next($request);
                }
            }

            else {
                return $next($request);
            }
        }

        return $next($request);
    }
}
