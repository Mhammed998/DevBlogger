<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class checkIfAdmin
{

    public function handle(Request $request, Closure $next): Response
    {

        if (Auth::user()->role  == 'Admin' || Auth::user()->role  == 'Owner' || Auth::user()->role  == 'Moderator' || Auth::user()->role  == 'Administrator'  ){
            return $next($request);
        }else{
            return redirect('/login');
        }
        // return $next($request);
    }
}
