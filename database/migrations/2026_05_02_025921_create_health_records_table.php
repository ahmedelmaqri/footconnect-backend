<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('health_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained('players')->cascadeOnDelete();
            $table->date('date');
            $table->float('weight')->nullable();
            $table->float('height')->nullable();
            $table->integer('heart_rate')->nullable();
            $table->integer('blood_pressure_sys')->nullable();
            $table->integer('blood_pressure_dia')->nullable();
            $table->enum('fitness_level', ['excellent', 'bon', 'moyen', 'faible'])->default('bon');
            $table->enum('injury_status', ['aucune', 'legere', 'moderee', 'grave'])->default('aucune');
            $table->text('injury_description')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('health_records');
    }
};