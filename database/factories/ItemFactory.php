<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kategori_id' => $this->faker->numberBetween(1, 3),
            'name' => $this->faker->unique()->sentence(1),
            'slug' => $this->faker->unique()->slug(),
            'description' => $this->faker->sentence(mt_rand(1,3)),
            'price' => $this->faker->numberBetween(15000,100000),
            'image' => 'items-images/default.jpg'
        ];
    }
}
