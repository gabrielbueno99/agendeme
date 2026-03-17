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

    public function findBy(array $fields): ?UserEntity
    {
        $conditions = [];
        $params = [];

        foreach($fields as $field => $value) {
            $conditions[] = "{$field} = :{$field}";
            $params[":{$field}"] = $value;
        }

        $where = implode(' AND ', $conditions);
        $query = "SELECT * FROM {$this->table} WHERE {$where}";
        $stmp = $this->connection->prepare($query);
        $stmp->execute($params);
        $res = $stmp->fetch(\PDO::FETCH_ASSOC);
        
        if(empty($res)) {
            return null;
        }

        $user = new UserEntity($res['id'],$res['role'],$res['name'],$res['email'],null);
        return $user;
    }

    public function save(?UserEntity $user)
    {
        if(isset($params['passwordHash'])) {
            $user->passwordHash = password_hash($user->passwordHash, PASSWORD_DEFAULT);
        }
        
        $query = "INSERT INTO {$this->table} (role, name, email, password_hash) VALUES (:role, :name, :email, :password)";
        $stmp = $this->connection->prepare($query);
        $stmp->execute([
            ':role'=> $user->getRole(),
            ':name'=> $user->name,
            ':email'=> $user->email,
            ':password'=> $user->passwordHash,
        ]);

        $user->id = $this->connection->lastInsertId();

        $data = [
            'email' => $user->email,
            'name' => $user->name,
            'role' => $user->getRole()
        ];
        
        return $data;
    }
}