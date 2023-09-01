<?php

namespace App\Domain\Companies\Actions;

use App\Domain\Companies\Models\Company;
use App\Exceptions\NotFoundException;

class AttachResourcesToCompanyAction
{
    public function execute(int $companyId, array $data)
    {
        $company = Company::find($companyId);
        if (!$company) {
            throw new NotFoundException('Company not found');
        }
        $resourceIds = explode(', ', $data['resource_ids']);
        $company->resources()->sync($resourceIds, false);
        return $company->resources()->get();
    }
}
