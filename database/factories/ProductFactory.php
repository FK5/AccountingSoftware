<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $company_name = $this->faker->word(),
            'description' => $this->faker->sentence(6, true),
            'sku' => '123-234-523',
            'category_id' => rand(1,4),
            'company_id' => rand(1,5),
            'sales_price' => rand(50,1000),
            'cost' => $this->faker->randomElement([0, rand(1,50)]),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
