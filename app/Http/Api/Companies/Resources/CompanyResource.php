<?php

namespace App\Http\Api\Companies\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
                'id' => $this->id,
                'name' => $this->name
        ];
    }
}
