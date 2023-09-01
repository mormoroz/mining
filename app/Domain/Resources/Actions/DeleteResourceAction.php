<?php

namespace App\Domain\Resources\Actions;

use App\Domain\Resources\Models\Resource;
use App\Exceptions\NotFoundException;

class DeleteResourceAction
{
    public function execute(int $resourceId): void
    {
        $resource = Resource::find($resourceId);
        if (!$resource) {
            throw new NotFoundException('Resource not found');
        }
        $resource->delete();
    }
}
