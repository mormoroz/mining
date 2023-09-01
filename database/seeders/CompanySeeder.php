<?php

namespace Database\Seeders;

use App\Domain\Companies\Models\Company;
use App\Domain\Resources\Models\Resource;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::factory(25)->create();

        $resources = Resource::all();
        Company::all()->each(function ($company) use ($resources) {
          $company->resources()->attach(
              $resources->random(rand(2, 8))->pluck('id')->toArray()
          );
        });
    }
}
