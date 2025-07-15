<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->email)->first();

        if(!$user){
            throw ValidationException::withMessages([
                'email' => ['Email is incorrect']
            ]);
        }

        if(!Hash::check($request->password, $user->password)){
            throw ValidationException::withMessages([
                'email' => ['password is incorrect']
            ]);
        }

        $token = $user->createToken('api-token')->plainTextToken;
        //'api-token' stored in the 'name' column of the personal_access_tokens table

        return response()->json([
            'token' => $token
        ]);
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'logged out'
        ]);
    }
}
