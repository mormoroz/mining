<?php

namespace App\Http\Api\Workers\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeWorkerRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['string', 'max:255'],
            'age' => ['integer', 'max:100'],
            'company_id' => ['integer']
        ];
    }
}
