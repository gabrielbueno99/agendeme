<?php

namespace App\Domain\Entities\RefreshToken;

use App\Domain\Entities\EntityInterface;
use App\Domain\Entities\RefreshToken\RefreshTokenEntityInterface;
use Firebase\JWT\JWT;

class RefreshTokenEntity implements RefreshTokenEntityInterface {

    public function __construct(
        public ?string $token,
        public ?string $user_id,
        public ?string $expires_at,
    ){}

    public function toArray(EntityInterface $entity)
    {
        return [
            'token' => $entity->token,
            'user_id' => $entity->user_id,
            'expires_at' => $entity->expires_at
        ];
    }
}