<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GruposSeeder extends Seeder
{
    public function run()
    {
        // Array com os nomes dos grupos
        $grupos = ['Grupo A', 'Grupo B', 'Grupo C', 'Grupo D', 'Grupo E', 'Grupo F', 'Grupo G', 'Grupo H'];

        // Criar os grupos na tabela "grupos"
        foreach ($grupos as $grupo) {
            DB::table('grupos')->insert([
                'nome' => $grupo
            ]);
        }
    }
}
