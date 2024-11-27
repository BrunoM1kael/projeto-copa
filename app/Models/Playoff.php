<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playoff extends Model
{
    use HasFactory;
    protected $fillable = [
        'fase',
        'adv1',
        'adv2',
        'gols1',
        'gols2',
        'penaltis',
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
