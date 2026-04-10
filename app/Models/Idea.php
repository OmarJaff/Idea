<?php

namespace App\Models;

use App\IdeaStatus;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Idea extends Model
{
    /** @use HasFactory<\Database\Factories\IdeaFactory> */
    use HasFactory;

    protected  $casts = [
      'links' => AsArrayObject::class,
        'status' => IdeaSTatus::class,
    ];

    public function user(): belongsTo {
        return $this->belongsTo(User::class);
    }
}
