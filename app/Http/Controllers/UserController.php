<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Helpers\JwtHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function getAllUser(Request $request)
    {
        $decodedToken = (array)JwtHelper::checkID($request);
        if (isset($decodedToken['error'])) {
            return response()->json($decodedToken);
        }

        $user = User::all();

        if (!$user) {
            return response()->json(['error' => 'User not found'], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json($user);
    }


    public function getUser(Request $request)
    {

        $decodedToken = (array)JwtHelper::checkID($request);
        if (isset($decodedToken['error'])) {
            return response()->json($decodedToken);
        }
        dd($decodedToken);

        $user = User::find($decodedToken['sub']);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json($user);
    }


    public function store(Request $request)
    {

        $decodedToken = (array)JwtHelper::checkID($request);
        if (isset($decodedToken['error'])) {
            return response()->json($decodedToken);
        }
        // dd($decodedToken);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:50|unique:m_user,email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'id' => (string) Str::uuid(),
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json($user, 201);
    }

    // Display the specified user
    public function show(Request $request, $id)
    {
        $decodedToken = (array)JwtHelper::checkID($request);
        if (isset($decodedToken['error'])) {
            return response()->json($decodedToken);
        }

        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    // Update the specified user in storage
    public function update(Request $request, $id)
    {
        $decodedToken = (array)JwtHelper::checkID($request);
        if (isset($decodedToken['error'])) {
            return response()->json($decodedToken);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            // 'email' => 'required|string|email|max:50|unique:m_user,email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::where('id', $id)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return response()->json($user);
    }

    // Remove the specified user from storage
    public function destroy(Request $request, $id)
    {
        $decodedToken = (array)JwtHelper::checkID($request);
        if (isset($decodedToken['error'])) {
            return response()->json($decodedToken);
        }

        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
