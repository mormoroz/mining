<?php

namespace App\Domain\Resources\Actions;

use App\Domain\Resources\Models\Resource;
use Illuminate\Support\Collection;
class GetAllResourceAction
{
    public function execute(): Collection
    {
        return Resource::all();
    }
}
