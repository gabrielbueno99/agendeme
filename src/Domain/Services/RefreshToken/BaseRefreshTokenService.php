<?php
namespace App\Domain\Services\RefreshToken;
use App\Domain\Repositories\RefreshToken\RefreshTokenRepositoryInterface;

class BaseRefreshTokenService {
    public function __construct(
        public RefreshTokenRepositoryInterface $repository
    ){}
}