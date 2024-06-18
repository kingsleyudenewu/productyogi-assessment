<?php

use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;

test('user can register into the system', function () {
    $user = persistUser();

    $payload = [
        'email' => $user->email,
        'name' => $user->name,
        'password' => 'password',
    ];

    $this->postJson('auth/register', $payload)
        ->assertStatus(201)
        ->assertJson(
            fn (AssertableJson $json) => $json->has('status')
                ->has('message', 'User created successfully')
                ->has('data', fn ($json) => $json->has('user'))
        )
        ->assertJsonFragment([
            'message' => 'User created successfully'
        ]);

    $user = User::latest()->first();
    expect($user->name)->toBeString()->not->toBeEmpty();
    expect($user->email)->toBeString()->toContain('@');
});


test('A user can login into the blog system', function () {
    $user = createUser();

    $payload = [
        'email' => $user->email,
        'password' => 'password',
    ];

    $this->postJson('auth/login', $payload)
        ->assertSuccessful()
        ->assertJson(
            fn (AssertableJson $json) => $json->has('status')
                ->has('message', 'User Logged In Successfully')
                ->has('data', fn ($json) => $json->has('token'))
        );
});

test('A user can log out of the system', function () {
    login()->postJson('auth/logout')
        ->assertSuccessful()
        ->assertJson(
            fn (AssertableJson $json) => $json->has('status')
                ->has('message', 'User Logged Out Successfully')
        );
});
