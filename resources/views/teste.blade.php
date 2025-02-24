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
        background-color: #f4f8f4;
        /* Cor de fundo clara */
        color: #333;
    }

    h1 {
        text-align: center;
        color: #2c6e49;
        /* Verde escuro */
    }

    h3 {
        text-align: center;
        color: #2c6e49;
        /* Verde escuro */
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
        background-color: #e9f5ec;
        /* Fundo verde claro */
        border-radius: 8px;
        /* Bordas arredondadas */
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
        color: #2c6e49;
        /* Verde escuro */
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
        background-color: #2c6e49;
        /* Verde escuro */
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #21633d;
        /* Verde mais escuro */
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
        background-color: #2c6e49;
        /* Verde escuro */
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button[type="submit"]:hover {
        background-color: #21633d;
        /* Verde mais escuro */
    }

    /* Responsividade */
    @media (max-width: 768px) {
        .match-container {
            width: 100%;
            /* Tabelas ocupam 100% da largura em telas pequenas */
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
    <h3 id="timer">Minuto: 0</h3>

    <div class="container">
        @foreach ($partidas as $partida)
            <div class="match-container" data-partida-id="{{ $partida->id }}">
                <div class="team">
                    <input type="text" readonly value="{{ $partida->time1->nome }}">
                </div>

                <div class="resultado">
                    <!-- Guardamos o resultado final em um data-final para uso na simulação -->
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


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
    // Oculta os botões no início
    $('#buttons').hide();

    function gerarMinutos(qtd) {
        let minutos = [];
        while (minutos.length < qtd) {
            let min = Math.floor(Math.random() * 90) + 1;
            if (!minutos.includes(min)) {
                minutos.push(min);
            }
        }
        return minutos.sort((a, b) => a - b);
    }

    function iniciarSimulacao() {
        $('.match-container').each(function () {
            const container = $(this);
            const inputGol1 = container.find('.gols1');
            const inputGol2 = container.find('.gols2');

            const finalGol1 = parseInt(inputGol1.data('final')) || 0;
            const finalGol2 = parseInt(inputGol2.data('final')) || 0;

            inputGol1.val(0);
            inputGol2.val(0);

            const golsTime1Minutos = gerarMinutos(finalGol1);
            const golsTime2Minutos = gerarMinutos(finalGol2);

            const totalMinutos = 90;
            const duracaoSimulacao = 5000; // 5 segundos para simular o jogo todo
            const intervalo = duracaoSimulacao / totalMinutos;
            let minutoAtual = 0;
            let placar1 = 0;
            let placar2 = 0;

            const timer = setInterval(function () {
                minutoAtual++;
                $('#timer').text("Minuto: " + minutoAtual); // Atualiza o tempo na tela

                if (golsTime1Minutos.includes(minutoAtual)) {
                    placar1++;
                    inputGol1.val(placar1);
                }
                if (golsTime2Minutos.includes(minutoAtual)) {
                    placar2++;
                    inputGol2.val(placar2);
                }

                if (minutoAtual >= totalMinutos) {
                    clearInterval(timer);
                    $('#buttons').fadeIn(); // Mostra os botões somente após 90 minutos
                }

            }, intervalo);
        });
    }

    // Inicia a simulação
    iniciarSimulacao();

    // Salvar resultado ao alterar gols manualmente
    $('.gols1, .gols2').on('change', function () {
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
            success: function (response) {
                console.log('Resultado salvo com sucesso!');
            },
            error: function (xhr, status, error) {
                console.error("Erro ao salvar os dados: ", error);
            }
        });
    });
});


        
    </script>

</body>

</html>
