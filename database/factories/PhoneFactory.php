<?php

namespace Database\Factories;

use App\Models\{Role, User};
use Illuminate\Database\Eloquent\Factories\Factory;

class PhoneFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id'      => User::all()->random()->id,
            'phone_number' => fake()->phoneNumber(),
        ];
    }
}
