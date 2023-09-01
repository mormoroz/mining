<?php

namespace App\Domain\Resources\Actions;

use App\Domain\Resources\Models\Resource;
use App\Exceptions\NotFoundException;

class ChangeResourceAction
{
    public function execute(int $resourceId, array $data): ?Resource
    {
        $resource = Resource::find($resourceId);
        if (!$resource) {
            throw new NotFoundException('Resource not found');
        }
        $resource->fill($data);
        $resource->save();
        return $resource;
    }
}
