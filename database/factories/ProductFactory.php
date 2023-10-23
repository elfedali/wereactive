<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Product;

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
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'slug' => $this->faker->slug,
            'description' => $this->faker->text,
            'price' => $this->faker->randomFloat(0, 0, 9999999999.),
            'quantity' => $this->faker->numberBetween(-10000, 10000),
            'on_sale' => $this->faker->boolean,
            'sale_price' => $this->faker->randomFloat(0, 0, 9999999999.),
            'sale_start' => $this->faker->dateTime(),
            'sale_end' => $this->faker->dateTime(),
            'is_featured' => $this->faker->boolean,
            'active' => $this->faker->boolean,
        ];
    }
}
