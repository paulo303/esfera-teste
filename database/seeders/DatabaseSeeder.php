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

        User::factory()->hasPhoneNumbers(2)->create([
            'name'    => 'Administrador',
            'email'   => 'admin@email.com',
            'role_id' => Role::ADMIN,
        ]);

        User::factory(2)->hasPhoneNumbers(2)->create();
    }
}
