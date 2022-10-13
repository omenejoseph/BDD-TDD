<?php

namespace App\Actions;

use App\Actions\Contracts\ActionAbleContract;
use App\Models\Client;

class CreateClientAction implements ActionAbleContract
{

    public function handle(array $data, ?\Closure $closure = null)
    {
        $client = Client::create(['name' => $data['company_name']]);

        $data['client'] = $client;

        return $closure ? $closure($data) : $client;
    }
}
