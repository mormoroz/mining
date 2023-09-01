<?php

namespace App\Http\Api\Resources\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateResourceRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'place' => ['required', 'string', 'max:255']
        ];
    }
}
