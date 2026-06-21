<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('vendors', function (Blueprint $table) {
            // Supprimer l'ancien user_id
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');

            // Ajouter auth columns
            $table->string('name')->after('id');
            $table->string('email')->unique()->after('name');
            $table->string('password')->after('email');
            $table->rememberToken()->after('password');
            $table->string('shop_name')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('vendors', function (Blueprint $table) {
            $table->dropColumn(['name', 'email', 'password', 'remember_token']);
            $table->foreignId('user_id')->constrained('players')->cascadeOnDelete();
        });
    }
};