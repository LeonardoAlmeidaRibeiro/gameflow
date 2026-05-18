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
        Schema::create('exercise_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('muscle_group_id')
                ->constrained('muscle_groups')
                ->onDelete('cascade');

            $table->string('nome');
            $table->text('descricao')->nullable();
            $table->string('imagem')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercise_categories');
    }
};
