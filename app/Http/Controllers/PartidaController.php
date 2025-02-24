<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResultadoFormRequest;
use App\Models\Classificacao;
use App\Models\Grupo;
use App\Models\Partida;
use App\Models\Times;
use Exception;
use Illuminate\Http\Request;

class PartidaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function adicionarPartidas($modo)
    {
        $grupos = Times::select('grupo_id')->distinct()->orderBy('grupo_id')->get();
        foreach ($grupos as $grupo) {
            $times = Times::where('grupo_id', $grupo->grupo_id)->get();
            if ($times->count() !== 4) {
                throw new Exception("O grupo {$grupo->grupo_id} não tem exatamente 4 times.");
            }

            $confrontos = [
                ['rodada' => 1, 'adv1' => 0, 'adv2' => 1],
                ['rodada' => 1, 'adv1' => 2, 'adv2' => 3],

                ['rodada' => 2, 'adv1' => 0, 'adv2' => 2],
                ['rodada' => 2, 'adv1' => 3, 'adv2' => 1],

                ['rodada' => 3, 'adv1' => 3, 'adv2' => 0],
                ['rodada' => 3, 'adv1' => 2, 'adv2' => 1],
            ];

            foreach ($confrontos as $confronto) {
                Partida::create([
                    'grupo_id' => $times[0]['grupo_id'],
                    'rodada' => $confronto['rodada'],
                    'adv1' => $times[$confronto['adv1']]->id,
                    'adv2' => $times[$confronto['adv2']]->id
                ]);
            }
        }

        return redirect()->route('add.classificacao', compact('modo'));
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
        return redirect()->route('partidas.rodada',  $rodada);
    }


    public function mostrarPartidasPorRodada($rodada)
{
    if ($rodada > 3) {
        return redirect()->back();
    }

    $partidas = Partida::with(['time1', 'time2'])->where('rodada', $rodada)->get();

    foreach ($partidas as $partida) {
        $partida->gols1 = rand(0, 5);
        $partida->gols2 = rand(0, 5);

        // Recupera a classificação de cada time
        $clas1 = Classificacao::with(['time1', 'time2'])
            ->where('times_id', $partida->adv1)
            ->first();
        $clas2 = Classificacao::with(['time1', 'time2'])
            ->where('times_id', $partida->adv2)
            ->first();

        $clas1->GM += $partida->gols1;
        $clas1->GC += $partida->gols2;
        $clas2->GM += $partida->gols2;
        $clas2->GC += $partida->gols1;

        $clas1->saldo_gols += $partida->gols1 - $partida->gols2;
        $clas2->saldo_gols += $partida->gols2 - $partida->gols1;

        if ($partida->gols1 > $partida->gols2) {
            $clas1->pontos += 3;
            $clas1->vitoria += 1;
            $clas2->derrota += 1;
            $partida->resultado = 'adv1';
        } elseif ($partida->gols1 < $partida->gols2) {
            $clas2->pontos += 3;
            $clas2->vitoria += 1;
            $clas1->derrota += 1;
            $partida->resultado = 'adv2';
        } else {
            $clas1->pontos += 1;
            $clas2->pontos += 1;
            $clas1->empate += 1;
            $clas2->empate += 1;
            $partida->resultado = 'Empate';
        }

        // Salva as alterações
        $clas1->save();
        $clas2->save();
        $partida->save();
    }

    $grupos = Grupo::all();

    return view('teste', compact('partidas', 'rodada', 'grupos'));
}
}
