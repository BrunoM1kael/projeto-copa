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

     public function adicionarGrupos($modo)
     {
         // Verifica se já existem grupos
         $grupos = Grupo::get('id')->implode('id');
     
         if ($grupos == '') {
             $nomesGrupos = ['Grupo A', 'Grupo B', 'Grupo C', 'Grupo D', 'Grupo E', 'Grupo F', 'Grupo G', 'Grupo H'];
             foreach ($nomesGrupos as $nome) {
                 DB::table('grupos')->insert([
                     'nome' => $nome
                 ]);
             }
         } else {
             DB::statement('SET FOREIGN_KEY_CHECKS=0;');
             DB::table('times')->truncate();
             DB::table('classificacao')->truncate();
             DB::table('partidas')->truncate();
             DB::table('playoffs')->truncate();
             DB::statement('SET FOREIGN_KEY_CHECKS=1;');
         }
         switch ($modo) {
             case 'times':
                 $rota = 'criar.times';
                 break;
             case 'normal.s':
             case 'random.s':
             case 'times.s':
                 $rota = 'add.grupos.super';
                 break;
             default:
                 $rota = 'add.selecoes';
                 break;
         }
     
         return redirect()->route($rota, compact('modo'));
     }
}
