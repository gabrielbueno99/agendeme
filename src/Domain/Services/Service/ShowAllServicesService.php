<?php

namespace App\Domain\Services\Service;

class ShowAllServicesService extends BaseServiceService {

    public function execute($id)
    {
        if(!empty($user)) {
            $user = $this->find_user_service->execute($id);

            if(empty($user)) {
                return [
                    'error' => 'User does not exists'
                ];
            }

            if($user->role !== 'prestador') {
                http_response_code(401);
                
                return [
                    'error' => 'This user does not have permission to get a service'
                ];
            }

            return $this->repository->getAll($user->id);
        }
        
        return $this->repository->getAll($id);


    }
}