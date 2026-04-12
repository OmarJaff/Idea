<?php

it('has a route for login page', function () {
    $this->get('/login')->assertStatus(200);
});

it('can login using login form', function () {
    $user =\App\Models\User::factory()->create(['password'=>'password@123']);

    visit('/login')
        ->fill('email', $user->email)
        ->fill('password', 'password@123')
        ->click('@login-btn')
         ->assertPathIs('/');

    $this->assertAuthenticated();
});
