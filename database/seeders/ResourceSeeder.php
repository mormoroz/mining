<?php

namespace Database\Seeders;

use App\Domain\Resources\Models\Resource;
use Illuminate\Database\Seeder;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Resource::factory(100)->create();
    }
}
