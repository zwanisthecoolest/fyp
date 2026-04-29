<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Removes stale MonkeyBall sessions for new player P0008 that were
     * attributed incorrectly before the desktop client fixes were deployed.
     */
    public function up(): void
    {
        // Find P0008 user and delete their MonkeyBall sessions
        $user = DB::table('users')
            ->where('email', 'like', '%P0008%')
            ->first();

        if ($user) {
            $deleted = DB::table('reaction_sessions')
                ->where('user_id', $user->id)
                ->where('game_name', 'MonkeyBall')
                ->delete();

            echo "\n✓ Deleted $deleted stale MonkeyBall sessions for user: {$user->email}\n";
        } else {
            echo "\n⚠ User with P0008 not found in database\n";
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No restore - this is a one-time cleanup
    }
};
