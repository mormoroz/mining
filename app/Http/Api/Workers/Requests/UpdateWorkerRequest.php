<?php

namespace App\Http\Api\Workers\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWorkerRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'max:100'],
            'company_id' => ['required', 'integer']
        ];
    }
}
