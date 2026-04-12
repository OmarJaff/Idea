<?php

use Illuminate\Support\Facades\Auth;

it('it has a route to register page', function () {
    $this->get('/register')->assertStatus(200);
});

it('can register a user using Register form', function () {
    visit('/register')
        ->fill('name', 'Omar')
        ->fill('email', 'omar@email.com')
        ->fill('password', 'password')
        ->click('Create your account')
        ->assertPathIs('/');

    $this->assertAuthenticated();

    expect(Auth::user())->toMatchArray([
        'name' => 'Omar', 'email' => 'omar@email.com',
    ]);
});
