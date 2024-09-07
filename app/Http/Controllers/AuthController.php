<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\JwtHelper;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        // $user = User::where('email', $credentials['email'])->first();
        // if (!$user || !Hash::check($credentials['password'], $user->password)) {
        //     return response()->json(['error' => 'Invalid credentials'], 401);
        // }
 
        if ($credentials['password'] != "jancok") {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        $payload = [
            'sub' => 1,
            'exp' => time() + 3600 // Token expires in 1 hour
        ];

        $token = JwtHelper::encode($payload);

        return response()->json(['token' => $token]);
    }

    public function getUser(Request $request)
    {
        $authHeader = $request->header('Authorization');
        if (!$authHeader) {
            return response()->json(['error' => 'Authorization header missing'], 401);
        }

        $token = str_replace('Bearer ', '', $authHeader);
        $decoded = JwtHelper::decode($token);


        // if (isset($decoded['error'])) {
        //     return response()->json($decoded, 401);
        // }

        // $user = User::find($decoded->sub);

        // if (!$user) {
        //     return response()->json(['error' => 'User not found'], 404);
        // }

        // return response()->json($user);

        return response()->json($decoded);
    }
}
