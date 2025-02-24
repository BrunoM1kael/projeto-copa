<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modos de Jogo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f8f4;
        }

        h1 {
            text-align: center;
            color: #2c6e49;
            margin-bottom: 30px;
        }

        .form-container {
            max-width: 800px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .form-item {
            width: 45%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        button {
            width: 250px; /* Largura fixa para garantir uniformidade */
            padding: 15px;
            font-size: 18px;
            color: white;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        button:active {
            transform: scale(1);
        }


        button:first-child:hover {
            background-color: #218838;
        }

        button:last-child {
            background-color: #ff9f00;
        }

        button:last-child:hover {
            background-color: #cc7a00;
        }

        .button-description {
            font-size: 14px;
            color: #6c757d;
            text-align: center;
            margin-top: 10px;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .form-item {
                width: 100%;
                align-items: center;
            }

            button {
                width: 100%; /* Ocupa toda a largura do contêiner em telas menores */
                font-size: 16px;
            }
        }
    </style>
</head>

<body>
    <h1>Modos de Jogo</h1>

    <div class="competition-selection">
        <button id="btn-copa-do-mundo">Jogar a Copa do Mundo</button>
        <button id="btn-super-mundial">Disputar o Super Mundial de Clubes</button>
    </div>
    
    <div id="config-copa-do-mundo" class="competition-config" style="display: none;">
        <button id="btn-voltar-copa" class="btn-back">&larr; Voltar</button>
        <h2>Configuração da Copa do Mundo</h2>
        <div class="form-container">
            <div class="form-item">
                <form action="{{ route('add.grupos', 'normal') }}">
                    <button type="submit">Grupos 2022 Padrão</button>
                </form>
                <div class="button-description">Grupos fixos conforme o sorteio oficial de 2022.</div>
            </div>
            <div class="form-item">
                <form action="{{ route('add.grupos', 'random') }}">
                    <button type="submit">Grupos 2022 Aleatórios</button>
                </form>
                <div class="button-description">Times distribuídos aleatoriamente nos grupos.</div>
            </div>
            <div class="form-item">
                <form action="{{ route('add.grupos', 'random.pote') }}">
                    <button type="submit">Grupos 2022 por Pote</button>
                </form>
                <div class="button-description">Distribuição dos times considerando os potes do sorteio.</div>
            </div>
            <div class="form-item">
                <form action="{{ route('add.grupos', 'times') }}">
                    <button type="submit">Criar Times</button>
                </form>
                <div class="button-description">Permite criar seus próprios times personalizados.</div>
            </div>
        </div>
    </div>
    
    <div id="config-super-mundial" class="competition-config" style="display: none;">
        <button id="btn-voltar-super" class="btn-back">&larr; Voltar</button>
        <h2>Configuração do Super Mundial de Clubes</h2>
        <div class="form-container">
            <div class="form-item">
                <form action="{{ route('add.grupos', 'normal.s') }}">
                    <button type="submit">Grupos Super Mundial Padrão</button>
                </form>
                <div class="button-description">Grupos fixos do Super Mundial de Clubes.</div>
            </div>
            <div class="form-item">
                <form action="{{ route('add.grupos', 'random.s') }}">
                    <button type="submit">Grupos Super Mundial Aleatórios</button>
                </form>
                <div class="button-description">Times do Super Mundial distribuídos aleatoriamente.</div>
            </div>
            <div class="form-item">
                <form action="{{ route('add.grupos', 'times.s') }}">
                    <button type="submit">Criar Times Super Mundial</button>
                </form>
                <div class="button-description">Permite criar seus próprios times para o Super Mundial.</div>
            </div>
        </div>
    </div>
</body>

<style>
    body {
        font-family: Arial, sans-serif;
        text-align: center;
    }

    .competition-selection {
        margin: 20px auto;
        display: flex;
        justify-content: center;
        gap: 20px;
    }

    .competition-selection button {
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        border: none;
        border-radius: 5px;
        background-color: #007bff;
        color: white;
    }

    .competition-selection button:hover {
        background-color: #0056b3;
    }

    .competition-config {
        margin-top: 20px;
    }

    .btn-back {
        display: inline-block;
        margin: 10px 0;
        padding: 5px 15px;
        font-size: 14px;
        background: none;
        border: none;
        color: #007bff;
        cursor: pointer;
        text-align: left;
    }

    .btn-back:hover {
        text-decoration: underline;
        color: #0056b3;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btnCopaDoMundo = document.getElementById('btn-copa-do-mundo');
        const btnSuperMundial = document.getElementById('btn-super-mundial');
        const btnVoltarCopa = document.getElementById('btn-voltar-copa');
        const btnVoltarSuper = document.getElementById('btn-voltar-super');
        const configCopaDoMundo = document.getElementById('config-copa-do-mundo');
        const configSuperMundial = document.getElementById('config-super-mundial');
        const competitionSelection = document.querySelector('.competition-selection');

        // Exibe a configuração da Copa do Mundo
        btnCopaDoMundo.addEventListener('click', () => {
            configCopaDoMundo.style.display = 'block';
            configSuperMundial.style.display = 'none';
            competitionSelection.style.display = 'none'; // Oculta os botões
        });

        // Exibe a configuração do Super Mundial
        btnSuperMundial.addEventListener('click', () => {
            configCopaDoMundo.style.display = 'none';
            configSuperMundial.style.display = 'block';
            competitionSelection.style.display = 'none'; // Oculta os botões
        });

        // Voltar para a seleção inicial
        btnVoltarCopa.addEventListener('click', () => {
            configCopaDoMundo.style.display = 'none';
            competitionSelection.style.display = 'flex'; // Mostra os botões
        });

        btnVoltarSuper.addEventListener('click', () => {
            configSuperMundial.style.display = 'none';
            competitionSelection.style.display = 'flex'; // Mostra os botões
        });
    });
</script>
</html>

