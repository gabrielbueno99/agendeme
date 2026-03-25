<?php

namespace App\Domain\Services\Service;

use App\Domain\Services\Service\BaseServiceService;
use App\Domain\Entities\Service\ServiceEntity;

class RegistrationServiceService extends BaseServiceService {
    public function execute($data)
    {
        $provider_exists = $this->find_user_service->execute($data['provider_id']);

        if(empty($provider_exists)) {
            return [
                'error' => 'Provider does not exists'
            ];
        }

        if($provider_exists->role !== 'prestador') {
            return [
                'error' => 'This user does not have permission to create a service'
            ];
        }

        $service = new ServiceEntity(
            '',
            $data['provider_id'],
            $data['name'],
            $data['description'],
            $data['price'],
            $data['duration_minutes']
        );

        return $this->repository->save($service);
    }
}