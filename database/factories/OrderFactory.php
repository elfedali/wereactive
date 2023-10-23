<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\Shop;
use App\Models\User;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'shop_id' => Shop::factory(),
            'status' => $this->faker->randomElement(["pending","processing","completed","cancelled"]),
            'shipping_address' => $this->faker->word,
            'shipping_phone' => $this->faker->word,
            'shipping_email' => $this->faker->word,
            'shipping_name' => $this->faker->word,
            'shipping_city' => $this->faker->word,
            'shipping_country' => $this->faker->word,
            'shipping_zip' => $this->faker->word,
            'shipping_state' => $this->faker->word,
            'shipping_indications' => $this->faker->word,
            'tax' => $this->faker->randomFloat(0, 0, 9999999999.),
            'sub_total' => $this->faker->randomFloat(0, 0, 9999999999.),
            'total' => $this->faker->randomFloat(0, 0, 9999999999.),
        ];
    }
}
