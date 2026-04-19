<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReactionSession extends Model
{
    protected $fillable = [
        'game_name',
        'player_name',
        'user_id',
        'score',
        'attempts',
        'hits',
        'misses',
        'avg_reaction_time_ms',
        'best_reaction_time_ms',
        'worst_reaction_time_ms',
        'reaction_times',
        'duration_ms',
        'started_at',
        'ended_at',
        'meta',
    ];

    protected $casts = [
        'reaction_times' => 'array',
        'meta' => 'array',
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];
}
