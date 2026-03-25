<?php

namespace App\Application\Actions\Service;

use App\Application\Actions\BaseAction;

class ShowServiceAction extends BaseAction {
    public function __construct()
    {
        throw new \Exception('Not implemented');
    }

    public function show($id)
    {
        $data = $this->verifyBodyContent();

        if(empty($id) || empty($data['provider_id'])) {
            return [
                'error' => 'ID is not set'
            ];
        }

    }
}