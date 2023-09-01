<?php

namespace Database\Seeders;

use App\Domain\Workers\Models\Worker;
use Illuminate\Database\Seeder;

class WorkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Worker::factory(200)->create();
    }
}
