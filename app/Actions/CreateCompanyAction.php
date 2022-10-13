<?php

namespace App\Actions;

use App\Actions\Contracts\ActionAbleContract;
use App\Models\Company;

class CreateCompanyAction implements ActionAbleContract
{

    public function handle(array $data, ?\Closure $closure = null)
    {
        $company = Company::create([
            'name' => $data['company_name'],
            'number_of_employees' => $data['number_of_employees'],
            'client_id' => $data['client']->id
        ]);

        $data['company'] = $company;

        return $closure ? $closure($data) : $company;
    }
}
