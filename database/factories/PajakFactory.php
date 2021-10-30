<?php

namespace Database\Factories;

use App\Models\Pajak;
use Illuminate\Database\Eloquent\Factories\Factory;

class PajakFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pajak::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->sentence(1),
            'rate' => $this->faker->numberBetween(1,10),
            'description' => $this->faker->unique()->slug(1),
        ];
    }
}
