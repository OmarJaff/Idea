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
        ->fill('@new-link', 'https://laravel.com')
        ->click('@add-new-link')
        ->fill('@new-link', 'https://laracasts.com')
        ->click('@add-new-link')
        ->click('Create')
        ->assertPathIs('/ideas');

    expect($user->ideas()->first())->toMatchArray([
        'title' => 'a new idea',
        'status' => 'completed',
        'description' => 'this is description',
        'links' => ['https://laravel.com', 'https://laracasts.com'],
    ]);
});

it('validates the fields server side', function () {
    $this->actingAs(User::factory()->create());

    $page = visit('/ideas')
        ->click('@create-new-idea');

    $page->script('document.getElementById("title").removeAttribute("required")');
    $page->script('document.getElementById("description").removeAttribute("required")');

    $page->fill('title', '')
        ->click('@button-status-completed')
        ->fill('description', '')
        ->click('Create')
        ->assertPathIs('/ideas')
        ->click('@create-new-idea')
        ->assertSee('The description field is required.')
        ->assertSee('The title field is required');

});
