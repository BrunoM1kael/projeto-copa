<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResultadoFormRequest;
use App\Models\Classificacao;
use Illuminate\Support\Collection;
use App\Models\Grupo;
use App\Models\Partida;
use App\Models\Times;
use Illuminate\Http\Request;

class PartidaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function adicionarPartidas()
    {

        $grupos = Times::select('grupo_id')->distinct()->orderBy('grupo_id')->get();

        foreach ($grupos as $grupo) {
            // Recuperar os 4 times do grupo
            $times = Times::where('grupo_id', $grupo->grupo_id)->get();
            //dd($times);
            // Verificar se há exatamente 4 times
             if ($times->count() !== 4) {
                throw new Exception("O grupo {$grupo->grupo_id} não tem exatamente 4 times.");
            } 

            // Partidas seguindo as jornadas
            $jornadas = [
                // Rodada 1
                ['rodada' => 1, 'adv1' => 0, 'adv2' => 1],
                ['rodada' => 1, 'adv1' => 2, 'adv2' => 3],

                // Rodada 2
                ['rodada' => 2, 'adv1' => 0, 'adv2' => 2],
                ['rodada' => 2, 'adv1' => 3, 'adv2' => 1],

                // Rodada 3
                ['rodada' => 3, 'adv1' => 3, 'adv2' => 0],
                ['rodada' => 3, 'adv1' => 2, 'adv2' => 1],
            ];

            // Criar as partidas no banco
            foreach ($jornadas as $jornada) {
                Partida::create([
                    'grupo_id' => $times[0]['grupo_id'],
                    'rodada' => $jornada['rodada'],
                    'adv1' => $times[$jornada['adv1']]->id,
                    'adv2' => $times[$jornada['adv2']]->id,
                    'gols1' => 0,
                    'gols2' => 0,
                ]);
            }
        }

        return redirect()->route('add.classificacao');
    }

    /**
     * Show the form for creating a new resource.
     */


    public function salvarResultado(ResultadoFormRequest $request)
    {

        $partida = Partida::find($request->validate(['partida_id']));

        $partida->gols1 = $request->validate(['gols1']);
        $partida->gols2 = $request->validate(['gols2']);

        $partida->save();


        $rodada = $partida->rodada + 1;
        return redirect()->route('partidas.rodada', parameters: $rodada);
    }

    public function mostrarPartidasPorRodada($rodada)
    {
        if($rodada > 3 ) return redirect()->back();
        
        $partidas = Partida::with(['time1', 'time2'])->where('rodada', $rodada)->get();


        foreach ($partidas as $partida) {
            $classificacao1 = Classificacao::with(['time1', 'time2'])->where('times_id', $partida->adv1)->get();
            $classificacao2 = Classificacao::with(['time1', 'time2'])->where('times_id', $partida->adv2)->get();

            foreach($classificacao1 as $clas1);
            foreach($classificacao2 as $clas2){
            if (!$partida->gols1 && !$partida->gols2) {
                $partida->gols1 = rand(0, 5);
                $partida->gols2 = rand(0, 5);

                //dd($clas1, $clas2);

                $clas1->GM = $partida->gols1;
                $clas1->GC = $partida->gols2;

                $clas2->GM = $partida->gols2;
                $clas2->GC = $partida->gols1;
                $clas1->saldo_gols = $partida->gols1 - $partida->gols2;
                $clas2->saldo_gols = $partida->gols2 - $partida->gols1;
                if ($partida->gols1 > $partida->gols2) {
                    $clas1->pontos = $clas1->pontos + 3;

                    $clas1->vitoria = $clas1->vitoria + 1;

                    $clas2->derrota = $clas2->derrota + 1;

                    $partida->resultado = 'adv1';
                } elseif ($partida->gols1 < $partida->gols2) {
                    $clas2->pontos = $clas2->pontos + 3;

                    $clas2->vitoria = $clas2->vitoria + 1;

                    $clas1->derrota = $clas1->derrota + 1;

                    $partida->resultado = 'adv2';
                } else {
                    $clas1->pontos = $clas1->pontos +1;
                    $clas2->pontos = $clas2->pontos +1;
                    $clas1->empate = $clas1->empate + 1;
                    $clas2->empate = $clas2->empate + 1;
                    $partida->resultado = 'Empate';
                }
                $clas1->save();
                $clas2->save();
                $partida->save();
            }
        }}
        $grupos = Grupo::all();

        return view('teste', compact('partidas', 'rodada', 'grupos'));
    }
}
