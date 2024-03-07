<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\LogoutRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $validate = $request->validated();
        if (Auth::attempt($validate)) {
            if (request()->user()->getType() === "Admin") {

                $token = $request->user()->createToken('user', ['*'], now()->addHour());
                return response()->json([
                    'status' => 'Authorized',
                    'token' => $token->plainTextToken,
                    'token_type' => 'Bearer',
                    'expires_at' => (60 * 60) . 'seconds'
                ], 200);
            }
            $token = $request->user()->createToken('user', ['user-show', 'called-store',], now()->addMinutes(15));
            return response()->json([
                'status' => 'Authorized',
                'token' => $token->plainTextToken,
                'token_type' => 'Bearer',
                'expires' => (60 * 15) . 'seconds'
            ], 200);
        }
        return response()->json(['credentials' => 'invalidates'], 401);
    }
    public function logout(LogoutRequest $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['user' => $request->user()->getEmail(), "logout" => true], 200);
    }
}
