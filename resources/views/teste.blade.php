<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Partidas - Fase de Grupos</title>
</head>
<style>
    /* Estilo geral */
body {
    font-family: Arial, sans-serif;
    margin: 20px;
    background-color: #f4f8f4; /* Cor de fundo clara */
    color: #333;
}

h1 {
    text-align: center;
    color: #2c6e49; /* Verde escuro */
}

h3 {
    text-align: center;
    color: #2c6e49; /* Verde escuro */
}

/* Estilo para a Tabela da Fase de Grupos */
.container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 20px;
    padding: 20px;
}

.match-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 45%;
    border: 1px solid #ccc;
    padding: 10px;
    box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
    background-color: #e9f5ec; /* Fundo verde claro */
    border-radius: 8px; /* Bordas arredondadas */
    margin-bottom: 20px;
}

.team {
    display: flex;
    flex: 1;
    justify-content: space-between;
    margin: 0 10px;
}

.resultado {
    font-weight: bold;
    color: #2c6e49; /* Verde escuro */
    font-size: 1.2rem;
}

.InputGol {
    max-width: 40px;
    text-align: center;
    font-size: 1.2rem;
}

button {
    display: block;
    margin: 20px auto;
    padding: 10px 20px;
    font-size: 16px;
    background-color: #2c6e49; /* Verde escuro */
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #21633d; /* Verde mais escuro */
}

.button-container {
    display: flex;
    justify-content: space-around;
    margin-top: 20px;
}

/* Ajustes para os botões */
button[type="submit"] {
    padding: 10px 20px;
    font-size: 16px;
    font-weight: bold;
    color: white;
    background-color: #2c6e49; /* Verde escuro */
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #21633d; /* Verde mais escuro */
}

/* Responsividade */
@media (max-width: 768px) {
    .match-container {
        width: 100%; /* Tabelas ocupam 100% da largura em telas pequenas */
    }

    .button-container {
        flex-direction: column;
        align-items: center;
    }
}

</style>
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
