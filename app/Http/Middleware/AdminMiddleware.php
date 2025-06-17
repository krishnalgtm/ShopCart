<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AdminMiddleware
{


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        // चेक करें कि यूजर मौजूद है और पासवर्ड सही है
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    
        // चेक करें कि यूजर का रोल 'admin' है
        if (!$user->hasRole('admin')) {
            return response()->json(['message' => 'Unauthorized: Admin access only'], 403);
        }
    
        // टोकन बनाएं
        $token = $user->createToken('AdminApp', ['admin'])->accessToken;
    
        return response()->json(['token' => $token], 200);
    }
    

    public function handle(Request $request, Closure $next)
    {
        // चेक करें कि यूजर लॉग इन है और उसका रोल 'admin' है
        if (Auth::check() && Auth::user()->hasRole('admin')) {
            return $next($request);
        }
    
        // यदि यूजर एडमिन नहीं है, तो उसे होम पेज पर रीडायरेक्ट करें
        return redirect('/home')->withErrors(['message' => 'Access Denied. Admins only.']);
    }
    
    
}
