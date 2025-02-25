@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/playoffs.css') }}">
@endsection


@section('scripts')
<script src="{{ asset('js/playoff.js') }}"></script>
@endsection
    <h1>Playoffs - Copa do Mundo</h1>
    
    <div id="timer" style="text-align: center; font-size: 1.5em; margin-bottom: 10px;">
        Minuto: 0
    </div>

    <div class="phase-title" style="text-align: center">
        {{ ucfirst($fase) == 'Final' ? 'Final' : ucfirst($fase) . ' de Final' }}
    </div>
    
    @if ($fase)
        <div class="playoff-container {{ $fase === 'final' ? 'final-phase' : '' }}">
            <div class="playoff-column">
                @foreach ($partidas->slice(0, ceil($partidas->count() / 2)) as $partida)
                    <div class="match" data-final-gols1="{{ $partida->gols1 }}" data-final-gols2="{{ $partida->gols2 }}">
                        <div class="team">
                            <input type="text" readonly value="{{ $partida->time1->nome }}"
                                class="{{ $partida->vencedor == $partida->time1->id ? 'winner' : '' }}"
                                style="text-align: right">
                        </div>
                        <div class="score">
                            @if ($partida->penaltis)
                                <div class="penalty" style="display: none;">{{ $partida->penaltis }}</div>
                            @endif
                            <div class="display-score">0 x 0</div>
                        </div>
                        <div class="team">
                            <input type="text" readonly value="{{ $partida->time2->nome }}"
                                class="{{ $partida->vencedor == $partida->time2->id ? 'winner' : '' }}">
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="playoff-column">
                @foreach ($partidas->slice(ceil($partidas->count() / 2)) as $partida)
                    <div class="match" data-final-gols1="{{ $partida->gols1 }}" data-final-gols2="{{ $partida->gols2 }}">
                        <div class="team">
                            <input type="text" readonly value="{{ $partida->time1->nome }}"
                                class="{{ $partida->vencedor == $partida->time1->id ? 'winner' : '' }}"
                                style="text-align: right">
                        </div>
                        <div class="score">
                            @if ($partida->penaltis)
                                <div class="penalty" style="display: none;">{{ $partida->penaltis }}</div>
                            @endif
                            <div class="display-score">0 x 0</div>
                        </div>
                        <div class="team">
                            <input type="text" readonly value="{{ $partida->time2->nome }}"
                                class="{{ $partida->vencedor == $partida->time2->id ? 'winner' : '' }}">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <div id="buttons" style="display: none; text-align: center; margin-top: 20px;">
        @if ($fase === 'final')
            <form action="{{ route('home') }}">
                <button type="submit" class="btn btn-success">Terminar</button>
            </form>
            @php
                $campeao = $partidas->firstWhere('fase', 'final')->resultado;
                $timeCampeao = $campeao ? \App\Models\Times::find($campeao)->nome : 'Desconhecido';
            @endphp
        @else
            <form action="{{ route('add.playoff.fase') }}" method="POST">
                @csrf
                <input type="hidden" name="fase_atual" value="{{ $fase }}">
                <button type="submit" class="btn btn-primary">Avançar para próxima fase</button>
            </form>
        @endif
    </div>
