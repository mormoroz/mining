<?php

namespace App\Http\Api\Workers\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AllWorkerResources extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => WorkerResource::collection($this->collection),
        ];
    }
}
