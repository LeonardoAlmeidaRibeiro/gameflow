<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancePaymentMethod extends Model
{
    use HasFactory;

    protected $table = 'finance_payment_methods';

    protected $fillable = [
        'user_id',
        'tipo',
        'nome',
        'bandeira',
        'ultimos_digitos',
        'ativo',
    ];

    protected $casts = [
        'ativo' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function finances()
    {
        return $this->hasMany(Finance::class, 'payment_method_id');
    }

    public function getTipoLabelAttribute(): string
    {
        return [
            'credito' => 'Cartão de crédito',
            'debito' => 'Cartão de débito',
            'carteira_digital' => 'Carteira digital',
            'dinheiro' => 'Dinheiro',
        ][$this->tipo] ?? ucfirst((string) $this->tipo);
    }

    public function getDisplayNameAttribute(): string
    {
        $details = collect([$this->bandeira, $this->ultimos_digitos ? 'final ' . $this->ultimos_digitos : null])
            ->filter()
            ->implode(' - ');

        return trim($this->nome . ($details ? ' (' . $details . ')' : ''));
    }
}
