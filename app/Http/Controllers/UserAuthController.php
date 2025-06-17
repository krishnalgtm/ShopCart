<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class UserAuthController extends Controller
{
    public function signup(Request $request){

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('myApp')->accessToken;
        $user['name'] = $user->name;
        return response()->json(['success'=>$success],200);
      

    }

    // User Login
    function login(Request $request) {
        $user = User::where('email', $request->email)->first();
    
        if (!$user || !Hash::check($request->password, $user->password)) {
            return [
                'result' => 'User not found',
                'Success' => false
            ];
        }
    
        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['name'] = $user->name;
    
        return [
            'result' => $success,
            'msg' => 'User registered successfully'
        ];
    }
    
}
