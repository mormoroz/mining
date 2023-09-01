<?php

namespace App\Domain\Companies\Models;

use App\Domain\Resources\Models\Resource;
use App\Domain\Workers\Models\Worker;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function resources()
    {
        return $this->belongsToMany(Resource::class, 'resource_company');
    }

    public function workers()
    {
        return $this->hasMany(Worker::class, 'company_id', 'id');
    }
}
