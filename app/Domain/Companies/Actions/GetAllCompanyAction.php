<?php

namespace App\Domain\Companies\Actions;

use App\Domain\Companies\Models\Company;
use Illuminate\Support\Collection;

class GetAllCompanyAction
{
    public function execute(): Collection
    {
        return Company::all();
    }
}
