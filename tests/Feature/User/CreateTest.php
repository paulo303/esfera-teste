<?php

use App\Models\{Role, User};

use function Pest\Laravel\{actingAs, assertDatabaseHas, assertDatabaseMissing, get, post, seed};

beforeEach(function () {
    seed('RoleSeeder');
});

it('should be able to a admin see the form to create a user', function () {
    $admin = User::factory()->create(['role_id' => Role::ADMIN]);

    actingAs($admin);

    get(route('users.index'))->assertSee('Cadastrar usuário');
});

it('should not be able to a user see the form to create a user', function () {
    $user = User::factory()->create();

    actingAs($user);

    get(route('users.index'))->assertDontSee('Cadastrar usuário');
});

it('should be able to a admin create a user', function () {
    $admin = User::factory()->create(['role_id' => Role::ADMIN]);

    actingAs($admin);

    post(route('users.store'), [
        'name'                  => 'Test User',
        'email'                 => 'test@example.com',
        'password'              => 'password',
        'password_confirmation' => 'password',
        'role_id'               => Role::USER,
        'phone_numbers'         => [
            '(11) 99999-9999',
            '(22) 99999-9999',
        ],
    ])->assertRedirect();

    assertDatabaseHas('users', [
        'name'    => 'Test User',
        'role_id' => Role::USER,
    ]);
});

it('should not be able to a user create a user', function () {
    $user = User::factory()->create();

    actingAs($user);

    post(route('users.store'), [
        'name'                  => 'Test User',
        'email'                 => 'test@example.com',
        'password'              => 'password',
        'password_confirmation' => 'password',
        'role_id'               => Role::USER,
        'phone_numbers'         => [
            '(11) 99999-9999',
            '(22) 99999-9999',
        ],
    ])->assertForbidden();

    assertDatabaseMissing('users', [
        'name'    => 'Test User',
        'role_id' => Role::USER,
    ]);
});
