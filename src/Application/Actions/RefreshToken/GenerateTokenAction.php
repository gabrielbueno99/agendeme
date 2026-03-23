<?php

namespace App\Application\Actions\RefreshToken;

use App\Application\Actions\BaseAction;
use App\Domain\Services\RefreshToken\GenerateTokenService;

class GenerateTokenAction extends BaseAction {
    public function __construct(
        public GenerateTokenService $service
    ){}

    public function show()
    {
        $data = $this->verifyBodyContent();
        if(!isset($data['user_id']) || !isset($data['refresh_token'])) {
            http_response_code(500);
            return [
                'error' => "User id or Refresh token is empty"
            ];
        }

        return $this->service->execute($data);
    }
}