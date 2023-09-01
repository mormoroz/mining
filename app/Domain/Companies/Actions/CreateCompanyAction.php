<?php

namespace App\Domain\Companies\Actions;

use App\Domain\Companies\Models\Company;

class CreateCompanyAction
{
    public function execute(array $data): ?Company
    {
        return Company::create([
            'name' => $data['name']
        ]);
    }
}
