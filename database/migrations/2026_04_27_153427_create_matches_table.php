<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('home_team_id')->constrained('teams')->cascadeOnDelete();
            $table->foreignId('away_team_id')->constrained('teams')->cascadeOnDelete();
            $table->integer('home_score')->default(0);
            $table->integer('away_score')->default(0);
            $table->dateTime('date');
            $table->string('venue')->nullable();
            $table->string('competition')->nullable();
            $table->string('season');
            $table->enum('status', ['scheduled', 'live', 'finished'])->default('scheduled');
            $table->json('events')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};