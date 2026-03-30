<?php

namespace App\Domain\Services\Service;

class UpdateServiceService extends BaseServiceService {
    public function execute($data, $id)
    {
        $user = $this->verifyUser($data['provider_id']);

        if(is_array($user) && !empty($user['error'])) {
            return $user;
        }

        return $this->repository->update($data,$id);
    }
}