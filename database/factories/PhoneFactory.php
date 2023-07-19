<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PhoneFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'phone_number' => fake()->phoneNumber(),
        ];
    }
}
