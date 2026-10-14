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
            $table->string('score_type', 100);
            $table->unsignedSmallInteger('points')->default(1);
            $table->unsignedSmallInteger('minute')->nullable();
            $table->unsignedSmallInteger('period')->nullable();
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
            $table->unique(['match_id', 'player_id', 'score_type', 'period', 'minute'], 'unique_score');
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
