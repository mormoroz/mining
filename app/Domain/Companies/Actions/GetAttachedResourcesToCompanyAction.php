<?php

namespace App\Domain\Companies\Actions;

use App\Domain\Companies\Models\Company;
use App\Exceptions\NotFoundException;

class GetAttachedResourcesToCompanyAction
{
    public function execute(int $companyId)
    {
        $company = Company::find($companyId);
        if (!$company) {
            throw new NotFoundException('Company not found');
        }
        return $company->resources()->get();
    }
}
