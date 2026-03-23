<?php

namespace App\Application\Actions\User;

use App\Application\Middleware\Auth;
use App\Domain\Services\User\UserShowService;

class ShowUserAction {

    public function __construct(
        public readonly UserShowService $user
    )
    {}

    public function show($params)
    {   
        Auth::handle();
        return $this->user->execute($params);
    }
}