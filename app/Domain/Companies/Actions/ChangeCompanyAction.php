<?php

namespace App\Domain\Companies\Actions;

use App\Domain\Companies\Models\Company;
use App\Exceptions\NotFoundException;


class ChangeCompanyAction
{
    public function execute(int $companyId, array $data): ?Company
    {
        $company = Company::find($companyId);
        if (!$company) {
            throw new NotFoundException('Company not found');
        }
        $company->fill($data);
        $company->save();
        return $company;
    }
}
