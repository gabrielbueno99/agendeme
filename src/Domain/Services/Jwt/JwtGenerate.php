<?php

namespace App\Domain\Services\Jwt;
use Firebase\JWT\JWT;
use Exception;


class JwtGenerate {
    public static function generate($id)
    {
        try {
            $payload = [
                "iss" => getenv("JWT_ISS"),
                "iat" => time(),
                "exp" => time() + 420,
                "sub" => $id,
            ];
    
            $jwt =[
                'token' => JWT::encode($payload,getenv('JWT_SECRET_KEY'),'HS256')
            ];
    
            return $jwt;
        } catch (\Exception $e) {
            throw new Exception("Error Processing Request", 1);
        }
    }

    public static function generateRefreshToken()
    {
        return bin2hex(random_bytes(32));
    }
}