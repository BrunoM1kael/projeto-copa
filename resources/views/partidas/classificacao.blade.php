@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/classificação.css') }}">
@endsection


@section('scripts')
<script src="{{ asset('js/classificação.js') }}"></script>
@endsection

    <div class="tables-container">
        @foreach ($classificacao->chunk(4) as $grupo)
            <div class="table-group">
                <h2>{{ $grupo->first()->grupo->nome }}</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Posição</th>
                            <th>Time</th>
                            <th>PTS</th>
                            <th>VIT</th>
                            <th>E</th>
                            <th>DER</th>
                            <th>GM</th>
                            <th>GC</th>
                            <th>SG</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($grupo as $time)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $time->time1->nome }}</td>
                                <td>{{ $time->pontos }}</td>
                                <td>{{ $time->vitoria }}</td>
                                <td>{{ $time->empate }}</td>
                                <td>{{ $time->derrota }}</td>
                                <td>{{ $time->GM }}</td>
                                <td>{{ $time->GC }}</td>
                                <td>{{ $time->saldo_gols }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
    @if ($rodada == 3)
    <div class="button-container">
        <form action="{{ route('partidas.rodada', $rodada) }}">
            <button type="submit">Voltar</button>
        </form>
        <form action="{{ route('add.playoff', 'oitavas') }}">
            <button type="submit">Mata-Mata</button>
        </form>
    </div>
    @else
    <div>
        <form action="{{ route('partidas.rodada', $rodada) }}">
            <button type="submit">Voltar</button>
        </form>
    </div>
    <div>
        <form action="{{ route('partidas.rodada', $rodada+1) }}">
            <button type="submit">Próxima rodada</button>
        </form>
    </div>
    @endif

