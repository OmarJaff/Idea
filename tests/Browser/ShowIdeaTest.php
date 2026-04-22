<?php

use App\Models\Idea;

it('requires authentication', function () {

    $idea = Idea::factory()->create();

    visit(route('idea.show', $idea))->assertPathIs('/login');

});

it("doesn't allow showing an idea for another user", function () {

    $user = \App\Models\User::factory()->create();

    $this->actingAs($user);

    $idea = Idea::factory()->create();

    $this->get(route('idea.show', $idea))->assertForbidden();

});
