<?php

namespace App\Domain\Workers\Actions;

use App\Domain\Workers\Models\Worker;
use App\Exceptions\NotFoundException;

class GetWorkerAction
{
    public function execute(int $workerId): ?Worker
    {
        $worker = Worker::find($workerId);
        if (!$worker) {
            throw new NotFoundException('worker not found');
        }
        return $worker;
    }
}
