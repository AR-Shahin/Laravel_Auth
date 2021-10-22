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
        $name = $this->faker->sentence(3);
        $image = 'https://picsum.photos/id/' . rand(30, 600) . '/700/600';
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'des' => $this->faker->sentence(50),
            'image' =>  $image,
            'price' => rand(100, 500),
            'quantity' => rand(20, 50)
        ];
    }
}
