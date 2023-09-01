<?php

namespace App\Domain\Workers\Actions;

use App\Domain\Workers\Models\Worker;
use App\Exceptions\NotFoundException;

class DeleteWorkerAction
{
    public function execute(int $workerId): void
    {
        $worker = Worker::find($workerId);
        if (!$worker) {
            throw new NotFoundException('worker not found');
        }
        $worker->delete();
    }
}
