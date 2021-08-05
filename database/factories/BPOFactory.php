<?php

namespace Database\Factories;

use App\Models\BPO;
use Illuminate\Database\Eloquent\Factories\Factory;

class BPOFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BPO::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'systole' => rand(80, 150),
            'diastole' => rand(40, 100),
            'patient_id' => rand(1,1000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
