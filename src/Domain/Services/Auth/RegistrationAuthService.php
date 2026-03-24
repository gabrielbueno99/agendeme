<?php

namespace App\Domain\Services\Auth;

use App\Domain\Services\Auth\BaseAuthService;

class RegistrationAuthService extends BaseAuthService {
    public function execute($data)
    {
        $user = $this->user_repository->findBy(['email' => $data['email']]);

        if(empty($user)) {
            http_response_code(401);
            return [
                'error' => 'User not found. Check data'
            ];
        }

        $password = $user->passwordHash;

        if(!password_verify($data['password'],$password)) {
            http_response_code(401);
            return [
                'error' => 'email or password is incorrect'
            ];
        }

        $refresh_token_entity = $this->registration_refresh_token_service->execute($user->id);

        return $refresh_token_entity;
    }
}