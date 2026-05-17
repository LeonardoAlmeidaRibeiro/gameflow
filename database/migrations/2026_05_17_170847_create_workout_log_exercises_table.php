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
        Schema::create('workout_log_exercises', function (Blueprint $table) {
            $table->id();

            $table->foreignId('workout_log_id')
                ->constrained('workout_logs')
                ->onDelete('cascade');

            $table->foreignId('exercise_id')
                ->nullable()
                ->constrained('exercises')
                ->nullOnDelete();

            $table->string('nome_exercicio');

            $table->integer('series')->nullable();
            $table->integer('repeticoes')->nullable();
            $table->decimal('carga', 6, 2)->nullable();

            $table->text('observacao')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workout_log_exercises');
    }
};
