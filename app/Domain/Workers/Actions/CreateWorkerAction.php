<?php

namespace App\Domain\Workers\Actions;

use App\Domain\Workers\Models\Worker;

class CreateWorkerAction
{
    public function execute(array $data): ?Worker
    {
        return Worker::create([
            'name' => $data['name'],
            'age' => $data['age'],
            'company_id' => $data['company_id']
        ]);
    }
}
