<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partida extends Model
{
    use HasFactory;
    protected $fillable = [
        'grupo_id',
        'rodada',
        'adv1',
        'adv2',
        'gols1',
        'gols2',
        'resultado',
    ];
    public function grupo1()
    {
        return $this->belongsTo(Grupo::class);
    }
    public function time1()
    {
        return $this->belongsTo(Times::class, 'adv1');
    }

    public function time2()
    {
        return $this->belongsTo(Times::class, 'adv2');
    }
}
