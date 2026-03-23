<?php

namespace App\Infrastructure\Persistence\RefreshToken;

use App\Domain\Entities\EntityInterface;
use App\Infrastructure\Persistence\AbstractPDORepository;
use App\Domain\Entities\RefreshToken\RefreshTokenEntity;
use App\Domain\Repositories\RefreshToken\RefreshTokenRepositoryInterface;

class RefreshTokenPDORepository extends AbstractPDORepository  implements RefreshTokenRepositoryInterface {
    protected $table = 'refresh_tokens';

    protected function mapToEntity(array $data) :EntityInterface
    {
        $refresh_token = new RefreshTokenEntity(
            $data['token'],
            $data['user_id'],
            $data['expires_at']
        );

        return $refresh_token;
    }

    public function matchRefreshToken($data): ?array
    {
        $query = "SELECT u.id 
              FROM users u 
              INNER JOIN {$this->table} rt ON u.id = rt.user_id 
              WHERE rt.user_id = ? 
                AND rt.token = ?  
                AND rt.revoked = 0 
                AND rt.expires_at > NOW() 
             LIMIT 1";
        $stmp = $this->connection->prepare($query);
        $stmp->execute([
            $data['user_id'],
            $data['refresh_token']
        ]);
        $res = $stmp->fetch(\PDO::FETCH_ASSOC);

        if(empty($res)) {
            return null;
        }

        return $res;
    }
}