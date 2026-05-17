<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    use HasFactory;

    protected $table = 'finance';

    protected $fillable = [
        'user_id',
        'titulo',
        'descricao',
        'tipo',
        'categoria_id',
        'valor',
        'mes',
        'ano',
        'status',
        'data_vencimento',
        'data_pagamento',
        'forma_pagamento',
        'payment_method_id',
        'recorrente',
        'recorrencia_tipo',
        'recorrencia_valor_tipo',
        'recorrencia_intervalo',
        'recorrencia_ate',
        'recorrencia_origem_id',
        'observacoes',
    ];

    protected $casts = [
        'valor' => 'decimal:2',
        'data_vencimento' => 'date',
        'data_pagamento' => 'date',
        'recorrente' => 'boolean',
        'recorrencia_ate' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(FinancePaymentMethod::class, 'payment_method_id');
    }

    public function recorrenciaOrigem()
    {
        return $this->belongsTo(Finance::class, 'recorrencia_origem_id');
    }

    public function recorrenciasGeradas()
    {
        return $this->hasMany(Finance::class, 'recorrencia_origem_id');
    }
}
