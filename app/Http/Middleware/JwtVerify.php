<?php

namespace App\Http\Middleware;

use App\Helpers\JwtHelper;
use App\Traits\JsonResponses;
use Closure;
use Firebase\JWT\ExpiredException;
use Illuminate\Http\Request;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class JwtVerify
{
    use JsonResponses;

    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('Authorization');
        if (!$token) {
            return $this->errorResponse("Token not provided", [], 401);
        }

        try {
            $decoded = JwtHelper::decode(str_replace('Bearer ', '', $token));
            Auth::loginUsingId($decoded->sub);
            if (!Auth::check()){
                return $this->errorResponse("User not found", [], 401);
            }
            return $next($request);
        } catch (ExpiredException $e) {
            return $this->errorResponse("Token expired", [], 401);
        } catch (\Exception $e) {
            Log::error("JwtVerify", ["error" => $e]);
            return $this->errorResponse("Invalid token", [], 401);
        }
    }
}
