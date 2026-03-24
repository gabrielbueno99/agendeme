<?php

namespace App\Domain\Services\Auth;

use App\Domain\Repositories\RefreshToken\RefreshTokenRepositoryInterface;
use App\Domain\Repositories\User\UserRepositoryInterface;
use App\Domain\Services\RefreshToken\RegistrationRefreshTokenService;
use App\Domain\Services\RefreshToken\RevokedRefreshTokenService;

abstract class BaseAuthService {
    public function __construct(
        public UserRepositoryInterface $user_repository,
        public RefreshTokenRepositoryInterface $refresh_token_repository,
        public RegistrationRefreshTokenService $registration_refresh_token_service,
        public RevokedRefreshTokenService $revoked_refresh_token_service
    ){}
}