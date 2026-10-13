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
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('match_id')->constrained('matches')->cascadeOnDelete();
            $table->foreignId('player_id')->constrained('players')->cascadeOnDelete();
            $table->foreignId('team_id')->constrained('sports_teams')->cascadeOnDelete();
            $table->enum('score_type', ['goal', 'own_goal', 'penalty_goal', 'free_kick', 'header', 'volley', 'assist', 'penalty_miss', 'chance_created']);
            $table->unsignedSmallInteger('minute')->nullable();
            $table->unsignedSmallInteger('second_half')->default(1);
            $table->unsignedSmallInteger('extra_time_minute')->nullable();
            $table->boolean('is_assisted')->default(false);
            $table->foreignId('assisted_by')->nullable()->constrained('players')->nullOnDelete();
            $table->text('description')->nullable();
            $table->string('video_url')->nullable();
            $table->datetime('scored_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['match_id', 'team_id']);
            $table->index(['player_id', 'score_type']);
            $table->index(['scored_at']);
            $table->unique(['match_id', 'player_id', 'score_type', 'minute'], 'unique_score');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};
