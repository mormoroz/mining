<?php

namespace App\Http\Api\Companies\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeCompanyRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['string', 'max:255'],
        ];
    }
}
