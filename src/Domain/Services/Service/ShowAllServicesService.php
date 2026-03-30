<?php

namespace App\Domain\Services\Service;

class ShowAllServicesService extends BaseServiceService {

    public function execute($id)
    {
        if(!empty($user)) {

            $user = $this->verifyUser($id);

            if(is_array($user) && !empty($user['error'])) {
                return $user;
            }

            return $this->repository->getAll($user->id);
        }
        
        return $this->repository->getAll($id);
    }
}