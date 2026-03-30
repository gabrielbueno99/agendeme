<?php

namespace App\Application\Actions\Service;

use App\Application\Actions\BaseAction;
use App\Application\Middleware\Auth;
use App\Domain\Services\Service\ShowServiceService;

class ShowServiceAction extends BaseAction {
    public function __construct(
        public ShowServiceService $service
    ){}

    public function show($id)
    {
        Auth::handle();

        if(empty($id)) {
            return ['error' => 'Some required fields are missing'];
        }

        return $this->service->execute($id);
    }
}