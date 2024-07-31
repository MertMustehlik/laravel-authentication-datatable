<?php

namespace App\Helpers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtHelper{

    public static function encode($payload)
    {
        return JWT::encode($payload, env("JWT_SECRET"), 'HS256');
    }

    public static function decode($token)
    {
        return JWT::decode($token, new Key(env("JWT_SECRET"), 'HS256'));
    }
}
