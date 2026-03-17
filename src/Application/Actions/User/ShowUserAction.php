<?php

namespace App\Application\Actions\User;
use App\Domain\Services\User\UserShowService;

class ShowUserAction {

    public function __construct(
        public readonly UserShowService $user
    )
    {}

    public function show($params)
    {   
        return $this->user->execute($params);
    }
}