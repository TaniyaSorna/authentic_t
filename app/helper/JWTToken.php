<?php

namespace App\helper;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Client\Request;

class JWTToken
{
    public static function CreateToken($userEmail, $userId)
    {
        $key = 'example_key';
        $payload = [
            'iss' => 'hello',
            // 'aud' => 'http://example.com',
            'iat' => time(),
            'exp' => time() + 3600,
            'userEmail' => $userEmail,
            'userId' => $userId
        ];
        return JWT::encode($payload, $key, 'HS256');
    }

    public static function verifyToken($token)
    {
        try {
            if ($token == null) {
                return 'unauth';
            } else {
                $key = 'example_key';
                return JWT::decode($token, new key($key, 'HS256'));
            }
        } catch (Exception $e) {
            return 'unauth';
        }
    }
}
