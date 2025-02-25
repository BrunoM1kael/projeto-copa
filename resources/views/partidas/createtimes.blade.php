@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/times.css') }}">
@endsection

    <h1>Adicionar 32 Times aos Grupos</h1>

    <form action="{{ route('adicionar.times') }}" method="POST">
        @csrf
        <div class="tables-container">
            @for ($grupoIndex = 0; $grupoIndex < 8; $grupoIndex++)
                <div class="table-group">
                    <h2>Grupo {{ chr(65 + $grupoIndex) }}</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Posição</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 1; $i <= 4; $i++)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>
                                        <input type="text" name="times[{{ $grupoIndex }}][]" placeholder="Time {{ $i }}" required>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            @endfor
        </div>
>
        <div class="button-container">
            <button type="submit" name="modo" value="padrão" class="btn-standard">Adicionar Times</button>
            <button type="submit" name="modo" value="random" class="btn-random">Randomizar Tabela</button>
        </div>
    </form>

