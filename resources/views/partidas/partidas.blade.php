@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/partidas.css') }}">
@endsection


@section('scripts')
    <script src="{{ asset('js/partidas.js') }}"></script>
@endsection
<h1>Tabela da Fase de Grupos</h1>
<h3>Rodada {{ $rodada }}</h3>
<div id="timer" style="text-align: center; font-size: 1.5em; margin-bottom: 10px;">
    Minuto: 0
</div>

<div class="container">
    @foreach ($partidas as $partida)
        <div class="match-container" data-partida-id="{{ $partida->id }}">
            <div class="team">
                <input type="text" readonly value="{{ $partida->time1->nome }}">
            </div>

            <div class="resultado">
                <input class="InputGol gols1" type="text" data-final="{{ $partida->gols1 }}"
                    value="{{ $partida->gols1 }}" readonly>
                x
                <input class="InputGol gols2" type="text" data-final="{{ $partida->gols2 }}"
                    value="{{ $partida->gols2 }}" readonly>
            </div>

            <div class="team">
                <input type="text" readonly value="{{ $partida->time2->nome }}">
            </div>
        </div>
    @endforeach
</div>

@if ($rodada == 3)
    <div id="buttons">
        <form action="{{ route('classificacao.index', $rodada) }}">
            <button type="submit">Classificação</button>
        </form>
    </div>
@else
    <div class="button-container" id="buttons" style="display: none;">
        <form action="{{ route('classificacao.index', $rodada) }}">
            <button type="submit">Classificação</button>
        </form>
        <form action="{{ route('partidas.rodada', $rodada + 1) }}">
            <button type="submit">Próxima rodada</button>
        </form>
    </div>
@endif
