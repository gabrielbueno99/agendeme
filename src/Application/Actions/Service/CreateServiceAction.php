<?php

namespace App\Application\Actions\Service;

use App\Application\Actions\BaseAction;
use App\Application\Middleware\Auth;
use App\Domain\Services\Service\RegistrationServiceService;

class CreateServiceAction extends BaseAction{
    public function __construct(
        public RegistrationServiceService $service
    ){}

    public function create()
    {
        Auth::handle();
        $data = $this->verifyBodyContent();

        if(empty($data)) {
            return [
                'error' => 'data is empty'
            ];
        }

        $required = ['provider_id', 'name', 'description', 'price', 'duration_minutes'];

        if (array_diff($required, array_keys($data))) {
            return ['error' => 'Some required fields are missing'];
        }
        
        return $this->service->execute($data);
    }
}