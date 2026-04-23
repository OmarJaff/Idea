<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Idea;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class UpdateIdea
{
    public function handel(array $attributes, Idea $idea): void
    {

        $data = collect($attributes)->only(['title', 'description', 'status', 'links'])->toArray();

        // Only store the image if it's an UploadedFile instance
        if (($attributes['image'] ?? false) instanceof UploadedFile) {
            $data['image_path'] = $attributes['image']->store('ideas', 'public');
        }

        DB::transaction(function () use ($data, $attributes, $idea) {

            // Update idea attributes
            $idea->update($data);

            // Normalize incoming steps to arrays with optional id, description and completed
            $incoming = collect($attributes['steps'] ?? [])->map(function ($step) {
                if (is_array($step)) {
                    return [
                        'id' => $step['id'] ?? null,
                        'description' => $step['description'] ?? ($step[0] ?? ''),
                        'completed' => isset($step['completed']) ? (bool) $step['completed'] : false,
                    ];
                }

                // If the step is just a string, treat it as a description
                return [
                    'id' => null,
                    'description' => $step,
                    'completed' => false,
                ];
            })->values();

            // Existing steps keyed by id for quick lookup
            $existing = $idea->steps()->get()->keyBy('id');

            $keepIds = $incoming->pluck('id')->filter()->values()->all();

            // Delete steps that are not present in the incoming payload
            if (empty($keepIds)) {
                $idea->steps()->delete();
            } else {
                $idea->steps()->whereNotIn('id', $keepIds)->delete();
            }

            // Update existing steps and create new ones
            foreach ($incoming as $stepData) {
                if ($stepData['id'] && $existing->has($stepData['id'])) {
                    $existing->get($stepData['id'])->update([
                        'description' => $stepData['description'],
                        'completed' => $stepData['completed'],
                    ]);
                } else {
                    $idea->steps()->create([
                        'description' => $stepData['description'],
                        'completed' => $stepData['completed'],
                    ]);
                }
            }

        });

    }
}
