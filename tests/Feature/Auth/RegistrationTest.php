<?php

use App\Models\Role;

use function Pest\Laravel\seed;

beforeEach(function () {
    seed();

});
test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $response = $this->post('/register', [
        'name'                  => 'Test User',
        'email'                 => 'test@example.com',
        'password'              => 'password',
        'password_confirmation' => 'password',
        'role_id'               => Role::USER,
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('users.index'));
});
