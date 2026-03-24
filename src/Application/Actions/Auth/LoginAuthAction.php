<?php

namespace App\Application\Actions\Auth;

use App\Application\Actions\BaseAction;
use App\Domain\Services\Auth\RegistrationAuthService;

class LoginAuthAction extends BaseAction {
    public function __construct(
        public RegistrationAuthService $service
    ){}

    public function login()
    {
        $data = $this->verifyBodyContent();

        if(!isset($data['password']) || !isset($data['email'])) {
            http_response_code(401);
            return [
                'error' => 'Incorrect data: email or password'
            ];
        }

        return $this->service->execute($data);
    }
}