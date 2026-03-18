<?php

namespace App\Application\Actions\User;

use App\Application\Actions\BaseAction;
use App\Domain\Services\User\UserUpdateService;

use function PHPSTORM_META\map;

class UpdateUserAction extends BaseAction{

    public function __construct(
        public UserUpdateService $user
    ){}

    public function update($id)
    {
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

        return $this->user->execute($data, $id);
    }
}