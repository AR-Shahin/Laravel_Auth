<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(3),
            'slug' => Str::slug($this->faker->sentence(3)),
            'des' => $this->faker->sentence(50),
            'image' => "https://via.placeholder.com/150x100",
            'price' => rand(100, 500),
            'quantity' => rand(20, 50)
        ];
    }
}
