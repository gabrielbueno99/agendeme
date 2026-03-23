<?php

namespace App\Application\Middleware;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;

class Auth {
    public static function handle()
    {
        $headers = getallheaders();

        if(!isset($headers['Authorization'])) {
            http_response_code(401);
            exit('invalid token');
        }

        $token = str_replace('Bearer ', '', $headers['Authorization']);

        try {
            $decode = JWT::decode(
                $token,
                new Key(getenv('JWT_SECRET_KEY'),'HS256')
            );

            return $decode;
        } catch (ExpiredException $e) {
            http_response_code(401);
            exit("Token inválido ou expirado: {$e}");
        } catch (Exception $e) {
            http_response_code(500);
            exit("Token inválido");
        }
    }
}
