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
        ->click('@register-btn')
        ->assertPathIs('/ideas');

    $this->assertAuthenticated();

    expect(Auth::user())->toMatchArray([
        'name' => 'Omar', 'email' => 'omar@email.com',
    ]);
});

it('validates the fields from server side', function () {
    visit('/register')
        ->fill('name', '')
        ->fill('email', '')
        ->fill('password', '')
        ->click('@register-btn')
        ->assertSee('The password field is required')
        ->assertSee('The email field is required.')
        ->assertSee('The password field is required.')
        ->assertPathIs('/register');
});
