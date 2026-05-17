<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('finance_payment_methods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('tipo', ['credito', 'debito', 'carteira_digital', 'dinheiro']);
            $table->string('nome');
            $table->string('bandeira')->nullable();
            $table->string('ultimos_digitos', 4)->nullable();
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });

        Schema::table('finance', function (Blueprint $table) {
            $table->foreignId('payment_method_id')
                ->nullable()
                ->after('forma_pagamento')
                ->constrained('finance_payment_methods')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('finance', function (Blueprint $table) {
            $table->dropConstrainedForeignId('payment_method_id');
        });

        Schema::dropIfExists('finance_payment_methods');
    }
};
