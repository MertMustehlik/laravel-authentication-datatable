<?php

namespace App\Http\Controllers;

use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\JsonResponses;


class AuthController extends Controller
{
    use JsonResponses;

    public function register()
    {

    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email or password'
            ], 401);
        }

        $jwtSecret = env("JWT_SECRET");
        $token = JWT::encode([
            "name" => Auth::user()->name,
            "email" => Auth::user()->email,
            "sub" => Auth::id(),
            "iat" => time(),
            "exp" => time() + 60 * 60 * 24 // 1 day
        ], $jwtSecret, 'HS256');


        return $this->successResponse("Login successful", ["token" => $token]);
    }

    public function check()
    {
        return $this->successResponse("", ["user" => Auth::user()]);
    }
}
