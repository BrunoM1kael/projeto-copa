<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Playoffs - Copa do Mundo</title>
    <style>
        /* Estilo geral */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f8f4;
            /* Cor de fundo clara */
        }

        h1 {
            text-align: center;
            color: #2c6e49;
            /* Verde escuro */
        }

        /* Container de playoffs */
        .playoff-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            padding: 20px;
        }

        /* Container das colunas esquerda e direita */
        .playoff-column {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        /* Centralizar o conteúdo da final */
        .final-phase .playoff-column {
            flex: 0 0 100%;
            /* Ocupa toda a largura */
            justify-content: center;
        }

        .phase-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #2c6e49;
            /* Verde escuro */
        }

        /* Estilo dos jogos */
        .match {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            max-width: 300px;
            border: 1px solid #ccc;
            padding: 10px;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            background-color: #e9f5ec;
            /* Fundo verde claro */
            transition: background-color 0.3s ease;
        }

        .match:hover {
            background-color: #d0e8d4;
            /* Efeito de hover suave */
        }

        .match .team {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            width: 50%;
            overflow-wrap: break-word;
            white-space: normal;
        }

        .team input {
            border: none;
            background: none;
            text-align: left;
            font-size: 16px;
            width: 100%;
        }

        .team .winner {
            font-weight: bold;
            color: green;
        }

        /* Estilo do score */
        .score {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            width: 20%;
        }

        /* Cor para a fase final */
        .phase-title.final {
            color: #ff9f00;
            /* Cor dourada para a final */
        }

        /* Penalidades */
        .penalty {
            font-size: 14px;
            color: gray;
        }

        /* Botões */
        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Botão de terminar */
        button.terminar {
            background-color: #28a745;
            /* Verde para o botão de terminar */
        }

        button.terminar:hover {
            background-color: #218838;
            /* Verde mais escuro */
        }

        /* Container do botão */
        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .playoff-container {
                flex-direction: column;
                align-items: center;
            }

            .match {
                width: 80%;
                /* Ajuste de largura para dispositivos móveis */
            }
        }
    </style>
</head>

<body>
    <h1>Playoffs - Copa do Mundo</h1>
    <div class="phase-title" style="text-align: center">
        {{ ucfirst($fase) == 'Final' ? 'Final' : ucfirst($fase) . ' de Final' }}
    </div>
    @if ($fase)
        <div class="playoff-container {{ $fase === 'final' ? 'final-phase' : '' }}">
            <!-- Coluna Esquerda -->
            <div class="playoff-column">

                @foreach ($partidas->slice(0, ceil($partidas->count() / 2)) as $partida)
                    <div class="match">
                        <div class="team ">
                            <input type="text" readonly value="{{ $partida->time1->nome }}"
                                class="{{ $partida->vencedor == $partida->time1->id ? 'winner' : '' }}"
                                style="text-align: right">
                        </div>
                        <div class="score">
                            @if ($partida->penaltis)
                                <div class="penalty">{{ $partida->penaltis }}</div>
                            @endif
                            <div>{{ $partida->gols1 }} x {{ $partida->gols2 }}</div>
                        </div>
                        <div class="team">
                            <input type="text" readonly value="{{ $partida->time2->nome }}"
                                class="{{ $partida->vencedor == $partida->time2->id ? 'winner' : '' }}">
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Coluna Direita -->
            <div class="playoff-column">
                @foreach ($partidas->slice(ceil($partidas->count() / 2)) as $partida)
                    <div class="match">
                        <div class="team">
                            <input type="text" readonly value="{{ $partida->time1->nome }}"
                                class="{{ $partida->vencedor == $partida->time1->id ? 'winner' : '' }}"style="text-align: right">
                        </div>
                        <div class="score">
                            @if ($partida->penaltis)
                                <div class="penalty">{{ $partida->penaltis }}</div>
                            @endif
                            <div>{{ $partida->gols1 }} x {{ $partida->gols2 }}</div>
                        </div>
                        <div class="team">
                            <input type="text" readonly value="{{ $partida->time2->nome }}"
                                class="{{ $partida->vencedor == $partida->time2->id ? 'winner' : '' }}">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @if ($fase === 'final')
        <form action="{{ route ('home') }}">
            <button type="submit" class="btn btn-success">
                Terminar
            </button>
        </form>
            @php
                $campeao = $partidas->firstWhere('fase', 'final')->resultado;
                $timeCampeao = $campeao ? \App\Models\Times::find($campeao)->nome : 'Desconhecido';
            @endphp
        @else
            <form action="{{ route('add.playoff.fase') }}" method="POST">
                @csrf
                <input type="hidden" name="fase_atual" value="{{ $fase }}">
                <button type="submit" class="btn btn-primary">
                    Avançar para próxima fase
                </button>
            </form>
        @endif
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
