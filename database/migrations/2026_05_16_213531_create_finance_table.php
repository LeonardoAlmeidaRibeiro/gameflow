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
        Schema::create('finance', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Dados principais
            $table->string('titulo');
            $table->text('descricao')->nullable();

            // Receita ou despesa
            $table->enum('tipo', ['receita', 'despesa']);

            // Categoria
            $table->foreignId('categoria_id')
                ->nullable()
                ->constrained('cad_bas_categoria')
                ->onDelete('set null');

            // Valor
            $table->decimal('valor', 10, 2);

            // Controle do mês
            $table->integer('mes');
            $table->integer('ano');

            // Status
            $table->enum('status', ['pendente', 'pago', 'cancelado'])
                ->default('pendente');

            // Datas
            $table->date('data_vencimento')->nullable();
            $table->date('data_pagamento')->nullable();

            // Forma de pagamento
            $table->string('forma_pagamento')->nullable();

            // Observações
            $table->text('observacoes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finance');
    }
};
