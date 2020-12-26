<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
// use Illuminate\Support\Facades\Response;


class SuperAdminMiddleware
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
        // if ($request->user() && $request->user()->type != ‘superadmin’)
        // {
        //     return new Response(view(‘unauthorized’)->with(‘role’, ‘SUPERADMIN’));
        // }
        // return $next($request);
        
        $role = Auth::user()->role;

        if (Auth::check() && Auth::user()->role == 'superadmin') {
            return $next($request);
        }
        elseif (Auth::check() && Auth::user()->role == 'admin') {
            return redirect()->route('unauthorized');
        }

        elseif (Auth::check() && Auth::user()->role == 'member') {
            return redirect()->route('unauthorized');
        }
        else {
            return view('welcome');
        }
    }
}
