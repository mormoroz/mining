<?php

namespace App\Http\Api\Companies\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DetachResourcesFromCompanyRequest extends FormRequest
{
    public function rules()
    {
        return [
            'resource_ids' => ['required', 'string', 'regex:/^\d+(,\s*\d+)*$/'],
        ];
    }
}

{

}
