<?php

namespace App\Domain\Resources\Actions;

use App\Domain\Resources\Models\Resource;
use App\Exceptions\NotFoundException;

class GetResourceAction
{
    public function execute(int $resourceId): ?Resource
    {
        $resource = Resource::find($resourceId);
        if (!$resource) {
            throw new NotFoundException('Resource not found');
        }
        return $resource;
    }
}
