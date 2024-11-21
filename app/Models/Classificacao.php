<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classificacao extends Model
{
    use HasFactory;

    protected $table = 'classificacao';

    protected $fillable = [
        'grupo_id',
        'times_id',
        'vitoria',
        'empate',
        'derrota',
        'GM',
        'GC',
        'saldo_gols',
        'pontos',
    ];
    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }
    
    public function time1()
    {
        return $this->belongsTo(Times::class, 'times_id');
    }

    public function time2()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }
}
