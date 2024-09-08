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
        $email = $request->input('email');
        $password = $request->input('password');

        // Check if email and password are provided
        if (!$email || !$password) {
            return response()->json(['error' => 'Email and password are required'], 400);
        }

        // Find the user by email
        $user = User::where('email', $email)->first();

        // Check if user exists and if password is correct
        if (!$user || !Hash::check($password, $user->password)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        $payload = [
            'sub' => 1,
            'exp' => time() + 3600 // Token expires in 1 hour
        ];

        $token = JwtHelper::encode($payload);

        return response()->json(['token' => $token]);
    }

}
