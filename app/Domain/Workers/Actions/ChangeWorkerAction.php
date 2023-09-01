<?php

namespace App\Domain\Workers\Actions;

use App\Domain\Workers\Models\Worker;
use App\Exceptions\NotFoundException;

class ChangeWorkerAction
{
    public function execute(int $workerId, array $data): ?Worker
    {
        $worker = Worker::find($workerId);
        if (!$worker) {
            throw new NotFoundException('worker not found');
        }
        $worker->fill($data);
        $worker->save();
        return $worker;
    }
}
