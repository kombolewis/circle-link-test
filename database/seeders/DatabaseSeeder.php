<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\BPOSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\PatientSeeder;
use Database\Seeders\UsersTableSeed;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RoleSeeder::class);
        $this->call(UsersTableSeed::class);
        $this->call(PatientSeeder::class);
        $this->call(BPOSeeder::class);
    }
}
