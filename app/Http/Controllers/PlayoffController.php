<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResultadoFormRequest;
use App\Models\Classificacao;
use App\Models\Playoff;
use Illuminate\Http\Request;

class PlayoffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function gerarPlayoffs($fase)
    {
        if ($fase == 'oitavas') {
            $classificacao = Classificacao::select('grupo_id', 'times_id', 'pontos', 'vitoria', 'empate', 'derrota', 'GM', 'GC', 'saldo_gols')
                ->orderBy('grupo_id', 'asc')
                ->orderBy('pontos', 'desc')
                ->orderBy('saldo_gols', 'desc')
                ->orderBy('GM', 'desc')
                ->orderBy('GC', 'asc')
                ->get()
                ->groupBy('grupo_id')
                ->map(fn($grupo) => $grupo->take(2));

            $confrontos = [
                ['grupo1' => '1', 'grupo2' => '2'],
                ['grupo1' => '3', 'grupo2' => '4'],
                ['grupo1' => '5', 'grupo2' => '6'],
                ['grupo1' => '7', 'grupo2' => '8'],
                ['grupo1' => '2', 'grupo2' => '1'],
                ['grupo1' => '4', 'grupo2' => '3'],
                ['grupo1' => '6', 'grupo2' => '5'],
                ['grupo1' => '8', 'grupo2' => '7'],
            ];

            foreach ($confrontos as $confronto) {
                $primeiroGrupo = $classificacao->get($confronto['grupo1']);
                $segundoGrupo = $classificacao->get($confronto['grupo2']);

                if ($primeiroGrupo && $segundoGrupo) {
                    $primeiroDoGrupo = $primeiroGrupo->first();
                    $segundoDoGrupo = $segundoGrupo->last();

                    Playoff::updateOrCreate([
                        'fase' => $fase,
                        'adv1' => $primeiroDoGrupo->times_id,
                        'adv2' => $segundoDoGrupo->times_id,
                    ], [
                        'gols1' => 0,
                        'gols2' => 0,
                        'penaltis' => 0,
                        'resultado' => 0,
                    ]);
                }
            }
            return redirect()->route('playoff.partidas', ['fase' => 'oitavas']);
        } elseif ($fase == 'quartas') {

            $partidas = Playoff::where('fase', 'oitavas')->get();

            if ($partidas->count() != 8) {
                return back()->withErrors('Número inválido de partidas das oitavas para gerar os confrontos das quartas.');
            }

            $confrontos = [
                ['grupo1' => $partidas[0]->resultado, 'grupo2' => $partidas[1]->resultado],
                ['grupo1' => $partidas[2]->resultado, 'grupo2' => $partidas[3]->resultado],
                ['grupo1' => $partidas[4]->resultado, 'grupo2' => $partidas[5]->resultado],
                ['grupo1' => $partidas[6]->resultado, 'grupo2' => $partidas[7]->resultado],
            ];

            foreach ($confrontos as $confronto) {
                $primeiroGrupo = $partidas->where('resultado', $confronto['grupo1'])->first();
                $segundoGrupo = $partidas->where('resultado', $confronto['grupo2'])->first();

                if ($primeiroGrupo && $segundoGrupo) {

                    Playoff::updateOrCreate([
                        'fase' => $fase,
                        'adv1' => $primeiroGrupo->resultado,
                        'adv2' => $segundoGrupo->resultado,
                    ], [
                        'gols1' => 0,
                        'gols2' => 0,
                        'penaltis' => 0,
                        'resultado' => 0,
                    ]);
                } else {
                    return back()->withErrors('Erro ao formar os confrontos das quartas. Grupos não encontrados.');
                }
            }

            return redirect()->route('playoff.partidas', ['fase' => 'quartas']);
        } elseif ($fase == 'semi') {

            $partidas = Playoff::where('fase', 'quartas')->get();


            if ($partidas->count() != 4) {
                return back()->withErrors('Número inválido de partidas das quartas para gerar os confrontos das semis.');
            }

            $confrontos = [
                ['grupo1' => $partidas[0]->resultado, 'grupo2' => $partidas[1]->resultado],
                ['grupo1' => $partidas[2]->resultado, 'grupo2' => $partidas[3]->resultado],
            ];

            foreach ($confrontos as $confronto) {
                $primeiroGrupo = $partidas->where('resultado', $confronto['grupo1'])->first();
                $segundoGrupo = $partidas->where('resultado', $confronto['grupo2'])->first();

                if ($primeiroGrupo && $segundoGrupo) {

                    Playoff::updateOrCreate([
                        'fase' => $fase,
                        'adv1' => $primeiroGrupo->resultado,
                        'adv2' => $segundoGrupo->resultado,
                    ], [
                        'gols1' => 0,
                        'gols2' => 0,
                        'penaltis' => 0,
                        'resultado' => 0,
                    ]);
                } else {
                    return back()->withErrors('Erro ao formar os confrontos das quartas. Grupos não encontrados.');
                }
            }

            return redirect()->route('playoff.partidas', ['fase' => 'semi']);
        } elseif ($fase == 'final') {
            $partidas = Playoff::where('fase', 'semi')->get();

            if ($partidas->count() != 2) {
                return back()->withErrors('Número inválido de partidas das semis para gerar os confrontos da final.');
            }

            $confrontos = [['grupo1' => $partidas[0]->resultado, 'grupo2' => $partidas[1]->resultado],];

            foreach ($confrontos as $confronto) {
                $primeiroGrupo = $partidas->where('resultado', $confronto['grupo1'])->first();
                $segundoGrupo = $partidas->where('resultado', $confronto['grupo2'])->first();

                if ($primeiroGrupo && $segundoGrupo) {
                    Playoff::updateOrCreate([
                        'fase' => $fase,
                        'adv1' => $primeiroGrupo->resultado,
                        'adv2' => $segundoGrupo->resultado,
                    ], [
                        'gols1' => 0,
                        'gols2' => 0,
                        'penaltis' => 0,
                        'resultado' => 0,
                    ]);
                } else {
                    return back()->withErrors('Erro ao formar os confrontos da final. Grupos não encontrados.');
                }
            }
            return redirect()->route('playoff.partidas', ['fase' => 'final']);
        }
        return redirect()->route('playoff.partidas', ['fase' => 'oitavas']);
    }
    public function addPlayoff(Request $request)
    {
        $faseAtual = $request->input('fase_atual');
        $novaFase = match ($faseAtual) {
            'oitavas' => 'quartas',
            'quartas' => 'semi',
            'semi' => 'final',
            default => null,
        };
        if (!$novaFase) {
            return redirect()->route('playoff.partidas', ['fase' => 'final'])
                ->with('error', 'Fase inválida ou já concluída.');
        }
        return redirect()->route('add.playoff', ['fase' => $novaFase]);
    }
    public function mostrarPartidasPorFase($fase)
    {
        if ($fase == 'oitavas') $partidas = Playoff::where('fase', 'oitavas')->get();
        elseif ($fase == 'quartas') $partidas = Playoff::where('fase', 'quartas')->get();
        elseif ($fase == 'semi') $partidas = Playoff::where('fase', 'semi')->get();
        elseif ($fase == 'final') $partidas = Playoff::where('fase', 'final')->get();

        foreach ($partidas as $partida) {
            if ($partida->gols1 === 0 && $partida->gols2 === 0) {
                $partida->gols1 = rand(0, 5);
                $partida->gols2 = rand(0, 5);

                if ($partida->gols1 > $partida->gols2) {
                    $partida->resultado = $partida->adv1;
                } elseif ($partida->gols1 < $partida->gols2) {
                    $partida->resultado = $partida->adv2;
                } else {
                    $this->processarPenaltis($partida);
                }

                $partida->save();
            }
        }

        // Certifique-se de que a view está sendo carregada corretamente
        return view('playoff', compact('partidas', 'fase'));
    }

    public function processarPenaltis($partida)
    {
        $penaltis1 = 0;
        $penaltis2 = 0;

        for ($i = 0; $i < 5; $i++) {
            $penaltis1 += rand(0, 1);
            $penaltis2 += rand(0, 1);
        }

        while ($penaltis1 === $penaltis2) {
            $penaltis1 += rand(0, 1);
            $penaltis2 += rand(0, 1);
        }

        $partida->penaltis = $penaltis1 . "x" . $penaltis2;

        if ($penaltis1 > $penaltis2) {
            $partida->resultado = $partida->adv1; // Adv1 vence
        } else {
            $partida->resultado = $partida->adv2; // Adv2 vence
        }
        $fase = $partida->fase;
        $partida->save();
        return redirect()->route('playoff.partidas', compact('fase'));
    }
    
}
