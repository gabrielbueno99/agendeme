<?php

namespace App\Infrastructure\Persistence\User;

use App\Domain\Repositories\User\UserRepositoryInterface;
use App\Infrastructure\Persistence\AbstractPDORepository;
use App\Domain\Entities\User\UserEntity;
class UserPDORepository extends AbstractPDORepository implements UserRepositoryInterface{
    protected $table = 'users';

    public function findById($id) : ?UserEntity {
        $query = "SELECT * FROM {$this->table} WHERE id = {$id}";
        $stmp = $this->connection->prepare($query);
        $stmp->execute();
        $res = $stmp->fetch(\PDO::FETCH_ASSOC);

        if(empty($res)) {
            return null;
        }

        $user = new UserEntity($id,$res['role'],$res['name'],$res['email'],null);

        return $user;
    }
}