<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('reaction_sessions')
            ->where('game_name', 'shape-match-hue')
            ->update(['game_name' => 'jungle-rush']);

        DB::table('game_reviews')
            ->where('game_name', 'shape-match-hue')
            ->update(['game_name' => 'jungle-rush']);
    }

    public function down(): void
    {
        DB::table('reaction_sessions')
            ->where('game_name', 'jungle-rush')
            ->update(['game_name' => 'shape-match-hue']);

        DB::table('game_reviews')
            ->where('game_name', 'jungle-rush')
            ->update(['game_name' => 'shape-match-hue']);
    }
};