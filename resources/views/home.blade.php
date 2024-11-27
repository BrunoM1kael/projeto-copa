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

        button:first-child {
            background-color: #28a745;
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
</body>

</html>
