<?php

use App\Models\{Role, User};

use function Pest\Laravel\{actingAs, get, seed};

beforeEach(function () {
    seed('RoleSeeder');
});

test('only authenticated users can see the list', function () {
    get(route('users.index'))->assertRedirect('login');
});

test('user list returns paginated data correctly', function () {
    $pagination    = 5;
    $usersToCreate = $pagination + 1;
    $users         = User::factory($usersToCreate)->create();
    $user          = User::factory()->create(['role_id' => Role::USER]);

    actingAs($user);
    $response = get(route('users.index'));

    for ($i = 0; $i < $pagination; $i++) {
        $response->assertSee($users[$i]->name);
    }

    $response->assertDontSee($users[$pagination]->name);
});
