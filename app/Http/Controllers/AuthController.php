<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{ 
   
    public function login(){
        // dd(Hash::make(123456));

    // if(!empty(Auth::check()))
    // {
    //     return redirect('admin/dashboard');
    // }
        return view('auth.login');
    }
    public function signup(){
     
        return view('auth.singup');
    }
    public function auth_login(Request $request)
    {
        $remember =!empty($request->remember)?  true :false;
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password] , $remember))
        {
            return redirect('admin/dashboard');
        }
        else{
            return redirect()->back()->with('error',"please enter currect email and password");
        }
        
    }

public function logout(){
    Auth::logout();
    return redirect(url(''));
}
    }