<?php

namespace App\Http\Controllers;

use App\Models\Times;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TimesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('createtimes');
    }
    public function adicionarSelecoes($modo)
    {


        $times = [
            'Catar',
            'Equador',
            'Senegal',
            'Países Baixos', // Grupo 1
            'Inglaterra',
            'Irã',
            'Estados Unidos',
            'País de Gales', // Grupo 2
            'Argentina',
            'Arábia Saudita',
            'México',
            'Polônia', // Grupo 3
            'França',
            'Austrália',
            'Dinamarca',
            'Tunísia', // Grupo 4
            'Espanha',
            'Costa Rica',
            'Alemanha',
            'Japão', // Grupo 5
            'Bélgica',
            'Canadá',
            'Marrocos',
            'Croácia', // Grupo 6
            'Brasil',
            'Sérvia',
            'Suíça',
            'Camarões', // Grupo 7
            'Portugal',
            'Gana',
            'Uruguai',
            'Coreia do Sul' // Grupo 8
        ];
        if ($modo == 'normal') {
            foreach ($times as $index => $time) {
                DB::table('times')->insert([
                    'nome' => $time,
                    'grupo_id' => (int)($index / 4) + 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        } elseif ($modo == 'random') {
            shuffle($times);
            foreach ($times as $index => $time) {
                DB::table('times')->insert([
                    'nome' => $time,
                    'grupo_id' => (int)($index / 4) + 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        } elseif ($modo == 'random.pote') {
            $grupos = 8;
            usort($times, function ($a, $b) {
                // Implemente sua lógica de comparação de força aqui
                return strcmp($a, $b);
            });
            $grupo = 1;
            foreach ($times as $time) {
                DB::table('times')->insert([
                    'nome' => $time,
                    'grupo_id' => $grupo,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $grupo = ($grupo % $grupos) + 1;
            }
        }elseif($modo == 'times') {
        return redirect()->route('criar.times', compact('modo'));
        }

        return redirect()->route('add.partidas', compact('modo'));
    }

    public function adicionarTimes(Request $request)
    {
        $times = $request->input('times'); 
    
        if ($request->modo == 'random') {
            // Converte $times para um array linear e embaralha
            $flattenedTimes = [];
            foreach ($times as $grupoTimes) {
                $flattenedTimes = array_merge($flattenedTimes, $grupoTimes);
            }
            shuffle($flattenedTimes);
    
            // Insere os times embaralhados com base no índice
            foreach ($flattenedTimes as $index => $time) {
                DB::table('times')->insert([
                    'nome' => $time,
                    'grupo_id' => (int)($index / 4) + 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        } else {
            // Insere os times no formato padrão (não embaralhado)
            foreach ($times as $grupoIndex => $grupoTimes) {
                foreach ($grupoTimes as $index => $time) {
                    $grupo_id = (int)($grupoIndex + 1);
                    Times::create([
                        'nome' => $time,
                        'grupo_id' => $grupo_id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    
        // Redireciona com o valor correto de 'modo'
        $modo = $request->modo;
        return redirect()->route('add.partidas', compact('modo'));
    }
    
}
