<?php

namespace App\Domain\Companies\Actions;

use App\Domain\Companies\Models\Company;
use App\Exceptions\NotFoundException;

class DetachResourcesFromCompanyAction
{
    public function execute(int $companyId, array $data)
    {
        $company = Company::find($companyId);
        if (!$company) {
            throw new NotFoundException('company not found');
        }
        $resourceIds = explode(', ', $data['resource_ids']);
        $company->resources()->detach($resourceIds);
        return $company->resources()->get();
    }
}
