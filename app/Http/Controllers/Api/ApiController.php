<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;


class ApiController extends Controller
{

    use HasApiTokens;

    public function index()
    {
        return response()->json([
            "status" => true,
            "message" => "Welcome to Laravel 11 Passport Auth API",
            "data" => []
        ]);
    }
    // User Registration
  
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
    

    // User Profile
    public function profile()
    {
        $userData = auth('api')->user();

        if (!$userData) {
            return response()->json([
                "status" => false,
                "message" => "Unauthorized access",
                "data" => []
            ], 401);
        }

        return response()->json([
            "status" => true,
            "message" => "Profile info retrieved successfully",
            "data" => $userData
        ]);
    }

    public function edit(){
        return response()->json(auth('api')->user());
    }

    // User Logout
    public function logout()
    {
        $user = auth('api')->user();

        if ($user) {
            // Revoke all tokens of the user
            $user->tokens()->delete();

            return response()->json([
                "status" => true,
                "message" => "Logout successfully"
            ]);
        }

        return response()->json([
            "status" => false,
            "message" => "Unable to logout",
        ], 401);
    }
}
