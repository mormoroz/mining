<?php

namespace App\Domain\Resources\Actions;

use App\Domain\Resources\Models\Resource;

class CreateResourceAction
{
    public function execute(array $data): ?Resource
    {
        return Resource::create([
            'name' => $data['name'],
            'place' => $data['place']
        ]);
    }
}
