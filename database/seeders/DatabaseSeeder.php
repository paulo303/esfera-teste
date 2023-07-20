<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\{Role, User};
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        User::factory()->hasPhoneNumbers()->create([
            'name'    => 'Administrador',
            'email'   => 'admin@email.com',
            'role_id' => Role::ADMIN,
        ]);

        User::factory()->hasPhoneNumbers(2)->create();
        User::factory()->hasPhoneNumbers()->create();
    }
}
