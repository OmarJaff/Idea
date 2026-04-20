<?php

use App\Models\Idea;
use App\Models\User;

it('belongs to a user', function () {
    $idea = Idea::factory()->create();
    expect($idea->user)->toBeInstanceOf(User::class);
});

it('can have steps', function () {
    $idea = Idea::factory()->create();

    expect($idea->steps)->toBeEmpty();

    $idea->steps()->create(['description' => 'Do the first step']);

    expect($idea->fresh()->steps)->toHaveCount(1);
});

it('creates an idea', function () {

    $this->actingAs($user = User::factory()->create());

    visit('/ideas')
        ->click('@create-new-idea')
        ->fill('title', 'a new idea')
        ->click('@button-status-completed')
        ->fill('description', 'this is description')
        ->click('Create')
        ->assertPathIs('/ideas');

    expect($user->ideas()->first())->toMatchArray([
        'title' => 'a new idea',
        'status' => 'completed',
        'description' => 'this is description'
    ]);
});

it('validates the description field', function () {
    $this->actingAs(User::factory()->create());

    visit('/ideas')
        ->click('@create-new-idea')
        ->fill('title', 'a new idea')
        ->click('@button-status-completed')
        ->fill('description', '')
        ->click('Create')
        ->assertPathIs('/ideas')
        ->click('@create-new-idea')
    ->assertsee('The description field is required.');

});
