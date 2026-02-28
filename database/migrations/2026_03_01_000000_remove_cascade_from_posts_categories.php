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
        Schema::table('posts', function (Blueprint $table) {
            // Drop the old foreign key constraint
            $table->dropForeign(['category_id']);
        });

        Schema::table('posts', function (Blueprint $table) {
            // Add the new foreign key constraint without cascade
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // Drop the new foreign key constraint
            $table->dropForeign(['category_id']);
        });

        Schema::table('posts', function (Blueprint $table) {
            // Restore the old foreign key constraint with cascade
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }
};
