<?php

namespace App\Domain\Resources\Models;

use App\Domain\Companies\Models\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'place'
    ];

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'resource_company');
    }
}
