<?php

namespace App\Application\Actions\Auth;

use App\Application\Actions\BaseAction;
use App\Domain\Services\Auth\LogoutAuthService;

class LogoutAuthAction extends BaseAction{
    public function __construct(
        public LogoutAuthService $service
    ){}

    public function logout()
    {
        $data = $this->verifyBodyContent();

        if(!isset($data['user_id']) || !isset($data['refresh_token'])) {
            return [
                'error' => 'ID user or Refresh token empty'
            ];
        }

        return $this->service->execute($data);


    }
}