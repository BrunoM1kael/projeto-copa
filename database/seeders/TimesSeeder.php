<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimesSeeder extends Seeder
{
    public function run()
    {
        $times = [
            'Catar', 'Equador', 'Senegal', 'Países Baixos', // Grupo 1
            'Inglaterra', 'Irã', 'Estados Unidos', 'País de Gales', // Grupo 2
            'Argentina', 'Arábia Saudita', 'México', 'Polônia', // Grupo 3
            'França', 'Austrália', 'Dinamarca', 'Tunísia', // Grupo 4
            'Espanha', 'Costa Rica', 'Alemanha', 'Japão', // Grupo 5
            'Bélgica', 'Canadá', 'Marrocos', 'Croácia', // Grupo 6
            'Brasil', 'Sérvia', 'Suíça', 'Camarões', // Grupo 7
            'Portugal', 'Gana', 'Uruguai', 'Coreia do Sul' // Grupo 8
        ];

        foreach ($times as $index => $time) {
            DB::table('times')->insert([
                'nome' => $time,
                'grupo_id' => (int)($index / 4) + 1, // Determina o grupo com base no índice
            ]);
        }
    }
}
