<?php

namespace Database\Seeders;

use App\Models\BPO;
use Illuminate\Database\Seeder;

class BPOSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BPO::factory()->times(2000)->create();
    
    }
}
