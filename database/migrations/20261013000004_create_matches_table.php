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
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tournament_id')->constrained('tournaments')->cascadeOnDelete();
            $table->foreignId('home_team_id')->constrained('sports_teams')->cascadeOnDelete();
            $table->foreignId('away_team_id')->constrained('sports_teams')->cascadeOnDelete();
            $table->enum('match_type', ['group', 'quarter_final', 'semi_final', 'final', 'third_place', 'round_of_16', 'round_of_32', 'friendly', 'playoff']);
            $table->string('group_name')->nullable();
            $table->unsignedSmallInteger('round_number')->nullable();
            $table->datetime('match_datetime');
            $table->string('venue')->nullable();
            $table->string('stadium')->nullable();
            $table->enum('status', ['scheduled', 'in_progress', 'completed', 'postponed', 'cancelled', 'abandoned', 'forfeited', 'drawn'])->default('scheduled');
            $table->unsignedSmallInteger('home_score')->default(0);
            $table->unsignedSmallInteger('away_score')->default(0);
            $table->boolean('overtime')->default(false);
            $table->unsignedSmallInteger('home_score_ot')->default(0);
            $table->unsignedSmallInteger('away_score_ot')->default(0);
            $table->boolean('penalty_shootout')->default(false);
            $table->unsignedSmallInteger('home_score_penalties')->default(0);
            $table->unsignedSmallInteger('away_score_penalties')->default(0);
            $table->string('referee')->nullable();
            $table->string('assistant_referee_1')->nullable();
            $table->string('assistant_referee_2')->nullable();
            $table->string('fourth_official')->nullable();
            $table->text('match_notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['tournament_id', 'status']);
            $table->index(['home_team_id', 'away_team_id']);
            $table->index(['match_datetime']);
            $table->unique(['tournament_id', 'home_team_id', 'away_team_id', 'match_type', 'group_name'], 'unique_match');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};
