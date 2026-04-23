<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class CreateIdea
{
    public function __construct(#[CurrentUser] protected User $user) {}

    public function handel(array $attributes): void
    {

        $data = collect($attributes)->only(['title', 'description', 'status', 'links'])->toArray();

        // Only store the image if it's an UploadedFile instance
        if (($attributes['image'] ?? false) instanceof UploadedFile) {
            $data['image_path'] = $attributes['image']->store('ideas', 'public');
        }

        DB::transaction(function () use ($data, $attributes) {

            $idea = $this->user->ideas()->create($data);

            // Normalize steps: accept strings or arrays with description and optional completed flag
            $steps = collect($attributes['steps'] ?? [])->map(function ($step) {
                if (is_array($step)) {
                    return [
                        'description' => $step['description'] ?? ($step[0] ?? ''),
                        'completed' => isset($step['completed']) ? (bool) $step['completed'] : false,
                    ];
                }

                return [
                    'description' => $step,
                    'completed' => false,
                ];
            })->values()->all();

            $idea->steps()->createMany($steps);

        });

    }
}
