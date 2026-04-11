<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\post;

it('it has a route to register page', function () {
    $this->get('/register')->assertStatus(200);
});

it('has a register form', function () {
    visit('/register')->assertSee('Register an account');
});

it('can register a user', function () {
    $response = post('/register', [
        'name' => 'Hama',
        'email' => 'hamajaff@gmail.com',
        'password' => 'password',

    ]);

    $response->assertRedirect('/'); // or expected page in your app
    expect(User::where('email', 'hamajaff@gmail.com')->exists())->toBeTrue();
    $this->assertAuthenticated();
});

it('can login a user', function () {

    User::create(['name' => 'hama', 'email' => 'hamajaff@gmail.com', 'password' => Hash::make('password')]);

    $response = post('/login', [
        'email' => 'hamajaff@gmail.com',
        'password' => 'password',
    ]);

    $response->assertRedirect('/'); // adjust if your app redirects elsewhere
    $this->assertAuthenticated();

});
