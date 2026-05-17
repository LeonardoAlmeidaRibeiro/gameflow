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
        Schema::create('workout_progress', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->date('data_registro');

            $table->integer('idade')->nullable();

            $table->decimal('peso', 5, 2)->nullable();
            $table->decimal('altura', 4, 2)->nullable();

            $table->integer('meta_kcal')->nullable();
            $table->integer('meta_necessaria')->nullable();

            $table->decimal('carboidrato', 6, 2)->nullable();
            $table->decimal('proteina', 6, 2)->nullable();
            $table->decimal('gordura', 6, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workout_progress');
    }
};
