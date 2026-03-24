<?php

namespace App\Domain\Services\Auth;

class LogoutAuthService extends BaseAuthService {
    public function execute($data)
    {
        return $this->revoked_refresh_token_service->execute($data);
    }
}