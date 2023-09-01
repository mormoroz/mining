<?php

namespace App\Domain\Workers\Actions;

use App\Domain\Workers\Models\Worker;
use Illuminate\Support\Collection;

class GetAllWorkerAction
{
    public function execute(): Collection
    {
        return Worker::all();
    }
}
