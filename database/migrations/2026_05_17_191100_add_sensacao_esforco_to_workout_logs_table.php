<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('workout_logs', function (Blueprint $table) {
            $table->unsignedTinyInteger('sensacao_esforco')
                ->nullable()
                ->after('dia_semana');
        });
    }

    public function down(): void
    {
        Schema::table('workout_logs', function (Blueprint $table) {
            $table->dropColumn('sensacao_esforco');
        });
    }
};
