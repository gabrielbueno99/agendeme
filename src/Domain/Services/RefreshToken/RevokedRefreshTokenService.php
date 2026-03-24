<?php

namespace App\Domain\Services\RefreshToken;

class RevokedRefreshTokenService extends BaseRefreshTokenService {
    public function execute($data)
    {
        $user = $this->repository->matchRefreshToken($data);

        if(empty($user)) {
            http_response_code(404);
            return [
                'error' => 'User does not match with refresh token'
            ];
        }

        $success = $this->repository->update(['revoked' => '1'], $data['user_id']);

        return [
            'success' => $success
        ];
    }
}