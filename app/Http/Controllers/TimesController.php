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
    public function adicionarTimesMundial($modo) {

       $times = [
            "Palmeiras",
            "Porto",
            "Al-Ahly",
            "Inter Miami",
            "Paris Saint-Germain",
            "Atlético de Madrid",
            "Botafogo",
            "Seattle Sounders",
            "Bayern de Munique",
            "Auckland City",
            "Boca Juniors",
            "Benfica",
            "Flamengo",
            "Espérance de Tunis",
            "Chelsea",
            "León",
            "River Plate",
            "Urawa Red Diamonds",
            "Monterrey",
            "Inter de Milão",
            "Fluminense",
            "Borussia Dortmund",
            "Ulsan",
            "Mamelodi Sundowns",
            "Manchester City",
            "Wydad Casablanca",
            "Al Ain",
            "Juventus",
            "Real Madrid",
            "Al-Hilal",
            "Pachuca",
            "RB Salzburg"
          ];
          
        if ($modo == 'normal.s') {
            foreach ($times as $index => $time) {
                DB::table('times')->insert([
                    'nome' => $time,
                    'grupo_id' => (int)($index / 4) + 1
                ]);
            }
        } elseif ($modo == 'random.s') {
            shuffle($times);
            foreach ($times as $index => $time) {
                DB::table('times')->insert([
                    'nome' => $time,
                    'grupo_id' => (int)($index / 4) + 1
                ]);
            }
        } elseif ($modo == 'random.pote.s') {
            $grupos = 8;
            usort($times, function ($a, $b) {
                return strcmp($a, $b);
            });
            $grupo = 1;
            foreach ($times as $time) {
                DB::table('times')->insert([
                    'nome' => $time,
                    'grupo_id' => $grupo
                ]);

                $grupo = ($grupo % $grupos) + 1;
            }
        }elseif($modo == 'times.s') {
        return redirect()->route('criar.times', compact('modo'));
        }

        return redirect()->route('add.partidas', compact('modo'));
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
                    'grupo_id' => (int)($index / 4) + 1
                ]);
            }
        } elseif ($modo == 'random') {
            shuffle($times);
            foreach ($times as $index => $time) {
                DB::table('times')->insert([
                    'nome' => $time,
                    'grupo_id' => (int)($index / 4) + 1
                ]);
            }
        } elseif ($modo == 'random.pote') {
            $grupos = 8;
            usort($times, function ($a, $b) {
                return strcmp($a, $b);
            });
            $grupo = 1;
            foreach ($times as $time) {
                DB::table('times')->insert([
                    'nome' => $time,
                    'grupo_id' => $grupo
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
                    'grupo_id' => (int)($index / 4) + 1
                ]);
            }
        } else {
            // Insere os times no formato padrão (não embaralhado)
            foreach ($times as $grupoIndex => $grupoTimes) {
                foreach ($grupoTimes as $index => $time) {
                    $grupo_id = (int)($grupoIndex + 1);
                    Times::create([
                        'nome' => $time,
                        'grupo_id' => $grupo_id
                    ]);
                }
            }
        }
    
        // Redireciona com o valor correto de 'modo'
        $modo = $request->modo;
        return redirect()->route('add.partidas', compact('modo'));
    }
    
}
