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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained('sports_teams')->cascadeOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('full_name')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('phone')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('position', 100)->nullable();
            $table->unsignedSmallInteger('jersey_number')->nullable();
            $table->decimal('height', 5, 2)->nullable();
            $table->decimal('weight', 5, 2)->nullable();
            $table->enum('dominant_foot', ['left', 'right', 'both'])->nullable();
            $table->enum('player_status', ['active', 'injured', 'suspended', 'retired', 'loaned_out'])->default('active');
            $table->text('notes')->nullable();
            $table->boolean('is_captain')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['team_id', 'is_captain']);
            $table->index(['position', 'player_status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
