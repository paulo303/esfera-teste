<?php

use App\Models\{Role, User};

use function Pest\Laravel\{actingAs, assertDatabaseMissing, assertSoftDeleted, delete, seed};

beforeEach(function () {
    seed('RoleSeeder');
});

test('only authenticated users delete', function () {
    $user = User::factory()->create();

    delete(route('users.destroy', $user))->assertRedirect('login');
});

it('should be able to a admin delete a user', function () {
    $admin = User::factory()->create(['role_id' => Role::ADMIN]);
    $user  = User::factory()->create();

    actingAs($admin);

    delete(route('users.destroy', $user))->assertRedirect(route('users.index'));

    assertSoftDeleted('users', ['id' => $user->id]);
});

it('should not be able to a user delete another user', function () {
    $user  = User::factory()->create();
    $user2 = User::factory()->create();

    actingAs($user);

    delete(route('users.destroy', $user2))->assertForbidden();
});
