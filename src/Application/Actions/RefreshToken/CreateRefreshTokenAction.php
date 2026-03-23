<?php

namespace App\Application\Actions\RefreshToken;

use App\Application\Actions\BaseAction;
use App\Domain\Services\RefreshToken\RegistrationRefreshTokenService;

class CreateRefreshTokenAction extends BaseAction{
    public function __construct(
        public RegistrationRefreshTokenService $service
    ){}

    public function create()
    {
        $data = $this->verifyBodyContent();

        if(!isset($data['user_id'])) {
            http_response_code(500);
            return [
                'error' => 'Id is not set'
            ];
        }

        return $this->service->execute($data['user_id']);
    }
}