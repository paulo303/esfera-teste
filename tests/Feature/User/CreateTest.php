<?php

use App\Models\User;

use function Pest\Laravel\get;

test('confirm password screen can be rendered', function () {

    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('users');

    $response->assertStatus(200);
});

test('only authenticated users can see the user page', function () {
    get(route('users.index'))->assertRedirect('login');
});
