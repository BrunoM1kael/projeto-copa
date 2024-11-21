<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Partidas - Fase de Grupos</title>
</head>

<body>

    <h1>Tabela da Fase de Grupos</h1>
    <h3>Rodada {{ $rodada }}</h3>

    <div class="container">
        @foreach ($partidas as $partida)
            <div class="match-container">
                <div class="team">
                    <input type="text" readonly value="{{ $partida->time1->nome }}">
                </div>

                <div class="resultado">
                    <input class="InputGol" type="text" class="gols1" data-partida-id="{{ $partida->id }}"
                        value="{{ $partida->gols1 }}" min="0" readonly>
                    x
                    <input class="InputGol" type="text" class="gols2" data-partida-id="{{ $partida->id }}"
                        value="{{ $partida->gols2 }}" min="0" readonly>
                </div>

                <div class="team">
                    <input type="text" readonly value="{{ $partida->time2->nome }}">
                </div>
            </div>
        @endforeach
    </div>

    @if ($rodada == 3)
    <form action="{{ route('classificacao.index', $rodada) }}">
        <button type="submit">Classificação</button>
    </form>
    @else
    <div class="button-container">
        <form action="{{ route('classificacao.index', $rodada) }}">
            <button type="submit">Classificação</button>
        </form>
        <form action="{{ route('partidas.rodada', $rodada + 1) }}">
            <button type="submit">Próxima rodada</button>
        </form>
    </div>
    @endif

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.gols1, .gols2').on('change', function() {
                const partidaId = $(this).data('partida-id');
                const gols1 = $(this).closest('.resultado').find('.gols1').val();
                const gols2 = $(this).closest('.resultado').find('.gols2').val();

                $.ajax({
                    url: "{{ route('partidas.salvar-resultado') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        partida_id: partidaId,
                        gols1: gols1,
                        gols2: gols2
                    },
                    success: function(response) {
                        console.log('Resultado salvo com sucesso!');
                    },
                    error: function(xhr, status, error) {
                        console.error("Erro ao salvar os dados: ", error);
                    }
                });
            });
        });
    </script>

</body>

</html>
