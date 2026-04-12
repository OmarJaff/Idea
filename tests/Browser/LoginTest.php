<?php

use App\Models\User;

it('has a route for login page', function () {
    $this->get('/login')->assertStatus(200);
});

it('can login using login form', function () {
    $user = User::factory()->create(['password' => 'password@123']);

    visit('/login')
        ->fill('email', $user->email)
        ->fill('password', 'password@123')
        ->click('@login-btn')
        ->assertPathIs('/');

    $this->assertAuthenticated();
});

it('logs out a user', function () {
    $user = User::factory()->create();
    $this->actingAs($user);
    visit('/')->click('@logout-btn');

    $this->assertGuest();

});
