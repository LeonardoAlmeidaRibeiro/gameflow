<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('exercises', function (Blueprint $table) {
            $table->foreignId('exercise_category_id')
                ->nullable()
                ->after('training_division_id')
                ->constrained('exercise_categories')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('exercises', function (Blueprint $table) {
            $table->dropForeign(['exercise_category_id']);
            $table->dropColumn('exercise_category_id');
        });
    }
};
