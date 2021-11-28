<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company_name' => $company_name = $this->faker->company(),
            'legal_name' => $this->faker->company(),
            'business_id' => $this->faker->numberBetween(1000, 9000),
            'company_email' => $this->faker->unique()->safeEmail(),
            'company_phone_number' => $this->faker->phoneNumber(),
            'company_address' => $this->faker->address(),
            'industry' => 'Entertainment',
            'website' => $company_name.".com",
            'approved' => $this->faker->numberBetween(0, 1),
            'user_id' => $this->faker->randomElement([null, rand(1,5)]),
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
