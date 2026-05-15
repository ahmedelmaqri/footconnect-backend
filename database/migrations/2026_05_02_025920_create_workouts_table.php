<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('workouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained('players')->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->json('exercises');
            $table->enum('difficulty', ['facile', 'moyen', 'difficile', 'extreme'])->default('moyen');
            $table->integer('duration_minutes')->default(60);
            $table->date('assigned_date');
            $table->boolean('completed')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workouts');
    }
};