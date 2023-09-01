<?php

namespace App\Http\Api\Companies\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AllCompanyResources extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => CompanyResource::collection($this->collection),
        ];
    }
}
