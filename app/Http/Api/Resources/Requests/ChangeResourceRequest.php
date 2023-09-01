<?php

namespace App\Http\Api\Resources\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeResourceRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['string', 'max:255'],
            'place' => ['string', 'max:255']
        ];
    }
}
