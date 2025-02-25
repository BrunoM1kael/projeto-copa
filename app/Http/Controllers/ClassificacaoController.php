<?php

namespace App\Http\Controllers;

use App\Models\Classificacao;
use App\Models\Partida;
use App\Models\Times;

class ClassificacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function adicionarClassificacao($modo)
    {
        $classificacoes = Partida::select('grupo_id')->distinct()->orderBy('grupo_id')->get();
        foreach ($classificacoes as $classificao) {
            $times = Times::where('grupo_id', $classificao->grupo_id)->get();
            foreach ($times as $time) {
                Classificacao::create([
                    'grupo_id' => $time->grupo_id,
                    'times_id' => $time->id
                ]);
            }
        }
        if($modo == 'random.pote')return redirect()->route('classificacao.index', 1);
        return redirect()->route('partidas.rodada', 1);
    }

    public function index($rodada)
    {
        if ($rodada > 3) return redirect()->back();

        $classificacao = Classificacao::select('grupo_id', 'times_id', 'pontos', 'vitoria', 'empate', 'derrota', 'GM', 'GC', 'saldo_gols')
            ->orderBy('grupo_id', 'asc')->orderBy('pontos', 'desc')->orderBy('saldo_gols', 'desc')
            ->orderBy('GM', 'desc')->orderBy('GC', 'asc')
            ->get();

        return view('partidas/classificacao', compact('classificacao', 'rodada'));
    }
}
