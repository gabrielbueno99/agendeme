<?php

namespace App\Application\Actions\Service;

use App\Application\Actions\BaseAction;
use App\Application\Middleware\Auth;
use App\Domain\Services\Service\UpdateServiceService;

class UpdateServiceAction extends BaseAction {
    public function __construct(
        public UpdateServiceService $service
    ){}

    public function update($id)
    {
        Auth::handle();

        $data = $this->verifyBodyContent();

        if(isset($data['error'])) {
            return $data;
        }

        if(empty($id)) {
            return [
                'error' => 'Invalid data',
                'message' => 'Invalid ID',
            ];
        }

        return $this->service->execute($data,$id);
    }
}