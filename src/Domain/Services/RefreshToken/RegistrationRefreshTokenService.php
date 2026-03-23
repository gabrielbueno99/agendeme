<?php

namespace App\Domain\Services\RefreshToken;

use App\Domain\Services\RefreshToken\BaseRefreshTokenService;
use App\Domain\Entities\RefreshToken\RefreshTokenEntity;
use App\Domain\Services\Jwt\JwtGenerate;
use DateTime;

class RegistrationRefreshTokenService extends BaseRefreshTokenService {
    public function execute($id)
    {
        $expiresAt = (new DateTime('+7 days'))->format('Y-m-d H:i:s');
        $token = JwtGenerate::generateRefreshToken();

        $refresh_token = new RefreshTokenEntity(
            $token,
            $id,
            $expiresAt
        );

        $hasRefresh_token = $this->repository->findBy(['user_id' => $id]);

        if(!empty($hasRefresh_token)) {
            return [
                'error' => 'Refresh token has already been created to this user'
            ];
        }

        $entity = $this->repository->save($refresh_token);

        if(empty($entity)) {
            return [
                'error' => 'Something went wrong'
            ];
        }

        $jwt = JwtGenerate::generate($id);

        return [
            'token' => $jwt['token'],
            'refresh_token' => $entity->token
        ];
    }
}