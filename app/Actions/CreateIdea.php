<?php

namespace App\Actions;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreateIdea {

    public function handel (array $attributes, ?User $user = null): void
    {

        $user ??= Auth::user();

        $data = collect($attributes)->only(['title','description', 'status','links'])->toArray();

        if($attributes['image'] ?? false)
        {
            $data['image_path'] = $attributes['image']->store('ideas','public');
        }

        DB::transaction(function() use ($user, $data) {

            $idea = $user->ideas()->create($data);

            $steps = collect($attributes['steps'] ?? [])->map(fn($step) => ['description' => $step]);

            $idea->steps()->createMany(
                $steps
            );

        });


    }
}
