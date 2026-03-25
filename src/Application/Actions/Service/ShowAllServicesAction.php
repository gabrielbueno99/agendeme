<?php

namespace App\Application\Actions\Service;

use App\Application\Actions\BaseAction;
use App\Application\Middleware\Auth;
use App\Domain\Services\Service\ShowAllServicesService;

class ShowAllServicesAction extends BaseAction {
    public function __construct(
        public ShowAllServicesService $service
    ){}

    public function show($id)
    {
        Auth::handle();

        return $this->service->execute($id);
    }
}