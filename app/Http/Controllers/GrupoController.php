<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Partida;
use App\Models\Times;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function adicionarGrupos()
    {


        $grupos = Grupo::get('id')->implode('id');

        //dd($grupos);
        if ($grupos == '') {
            $grupos = ['Grupo A', 'Grupo B', 'Grupo C', 'Grupo D', 'Grupo E', 'Grupo F', 'Grupo G', 'Grupo H'];

            // Criar os grupos na tabela "grupos"
            foreach ($grupos as $grupo) {
                DB::table('grupos')->insert([
                    'nome' => $grupo,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            return redirect()->route('add.selecoes');
        } else {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('times')->truncate();
            DB::table('classificacao')->truncate();
            DB::table('partidas')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');


            return redirect()->route('add.selecoes');
        }
    }
}
