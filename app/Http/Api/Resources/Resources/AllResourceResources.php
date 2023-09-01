<?php

namespace App\Http\Api\Resources\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AllResourceResources extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => ResourceResource::collection($this->collection),
        ];
    }
}
