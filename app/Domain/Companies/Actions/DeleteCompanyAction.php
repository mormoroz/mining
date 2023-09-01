<?php

namespace App\Domain\Companies\Actions;

use App\Domain\Companies\Models\Company;
use App\Exceptions\NotFoundException;

class DeleteCompanyAction
{
    public function execute(int $companyId): void
    {
        $company = Company::find($companyId);
        if (!$company) {
            throw new NotFoundException('Company not found');
        }
        $company->delete();
    }
}
