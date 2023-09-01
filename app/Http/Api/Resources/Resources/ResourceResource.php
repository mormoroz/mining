<?php

namespace App\Http\Api\Resources\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResourceResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
                'id' => $this->id,
                'name' => $this->name,
                'place' => $this->place
        ];
    }
}
