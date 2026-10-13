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
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('sport', ['football', 'basketball', 'volleyball', 'tennis', 'cricket', 'rugby', 'handball', 'futsal', 'baseball', 'hockey']);
            $table->enum('tournament_type', ['league', 'knockout', 'group_knockout', 'round_robin', 'double_elimination']);
            $table->unsignedSmallInteger('max_teams')->default(16);
            $table->unsignedSmallInteger('teams_per_group')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['draft', 'registration_open', 'ongoing', 'completed', 'cancelled', 'postponed'])->default('draft');
            $table->string('venue')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->decimal('entry_fee', 10, 2)->default(0);
            $table->string('prize_pool')->nullable();
            $table->text('rules')->nullable();
            $table->text('description')->nullable();
            $table->string('organizer')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('logo_path')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['sport', 'status']);
            $table->index(['start_date', 'end_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournaments');
    }
};
