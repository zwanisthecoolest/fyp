<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reaction_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('game_name', 100);
            $table->string('player_name', 100)->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedInteger('score')->default(0);
            $table->unsignedInteger('attempts')->nullable();
            $table->unsignedInteger('hits')->nullable();
            $table->unsignedInteger('misses')->nullable();
            $table->unsignedInteger('avg_reaction_time_ms')->nullable();
            $table->unsignedInteger('best_reaction_time_ms')->nullable();
            $table->unsignedInteger('worst_reaction_time_ms')->nullable();
            $table->json('reaction_times')->nullable();
            $table->unsignedInteger('duration_ms')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('ended_at')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();

            $table->index(['game_name', 'created_at']);
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reaction_sessions');
    }
};
