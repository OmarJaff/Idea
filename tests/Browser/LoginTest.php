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
        ->assertPathIs('/ideas');

    $this->assertAuthenticated();
});

it('logs out a user', function () {
    $user = User::factory()->create();
    $this->actingAs($user);
    visit('/')->click('@logout-btn');

    $this->assertGuest();
});

it('validates the email address and password server side', function () {
    visit('/login')
        ->fill('email', '')
        ->fill('password', '')
        ->click('@login-btn')
        ->assertSee('The email field is required.')
        ->assertSee('The password field is required.')
        ->assertPathIs('/login');
});
