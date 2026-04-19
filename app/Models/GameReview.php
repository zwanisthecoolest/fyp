<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameReview extends Model
{
    protected $table = 'game_reviews';

    protected $fillable = [
        'game_name',
        'player_name',
        'rating',
        'comment',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];
}
