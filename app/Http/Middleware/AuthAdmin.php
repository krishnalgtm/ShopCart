<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthAdmin
{
   
    public function handle(Request $request, Closure $next): Response
    {

        if (Auth::check()) {
            return $next($request); // User authenticated है
        } else {
            Auth::logout(); // अगर user authenticated नहीं है, तो logout कर दें
            return redirect('/login'); // User को login page पर redirect करें
        }
        
        if(Auth::check())
        {
            if(Auth::user()->utype === 'ADM')
            {
                return $next($request);
            }
            else
            {
                session()->flush();
                return redirect()->route('login');
            }
        }
        else
        {
            session()->flush();
            return redirect()->route('login');
        }        
    }
}
