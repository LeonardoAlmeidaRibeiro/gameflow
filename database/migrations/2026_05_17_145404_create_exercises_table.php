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
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();

            $table->foreignId('training_division_id')
                ->constrained('training_divisions')
                ->onDelete('cascade');

            $table->string('nome');

            $table->integer('series')->nullable();
            $table->integer('repeticoes')->nullable();

            $table->decimal('carga', 6, 2)->nullable();

            $table->integer('tempo_descanso')->nullable();

            $table->text('observacao')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
