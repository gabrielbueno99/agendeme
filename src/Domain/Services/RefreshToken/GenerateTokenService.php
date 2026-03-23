<?php

namespace App\Domain\Services\RefreshToken;

use App\Domain\Services\Jwt\JwtGenerate;
use App\Domain\Services\RefreshToken\BaseRefreshTokenService;

class GenerateTokenService extends BaseRefreshTokenService {
    public function execute($data)
    {
        $user_id = $this->repository->matchRefreshToken($data);

        if(empty($user_id)) {
            return [
                'error' => 'refresh does not exists'
            ];
        }

        $jwt = JwtGenerate::generate($user_id['id']);

        return $jwt;
    }
}