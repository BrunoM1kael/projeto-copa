<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Tabelas de Classificação</title>
</head>
<style>
body {
    font-family: Arial, sans-serif;
    margin: 20px;
    background-color: #f4f8f4; /* Cor de fundo clara */
    color: #333;
}

h1, h2, h3 {
    text-align: center;
    color: #2c6e49; /* Verde escuro */
}

h2 {
    margin-bottom: 15px;
    font-size: 1.5rem;
    font-weight: bold;
    text-transform: uppercase;
}

/* Estilo das tabelas */
.tables-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

.table-group {
    width: 45%;
    min-width: 300px;
    margin-bottom: 20px;
    background: #e9f5ec; /* Fundo verde claro */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombras leves */
    border-radius: 8px; /* Bordas arredondadas */
    padding: 10px;
}

table {
    width: 100%;
    text-align: center;
    border-collapse: collapse;
    margin-top: 10px;
}

th, td {
    padding: 10px;
    text-align: center;
}

td {
    background-color: #f9fcfa;
    max-width: 81px; /* Define o tamanho máximo da célula */
    overflow: hidden; /* Esconde o conteúdo que ultrapassar */
    text-overflow: ellipsis; /* Adiciona reticências para indicar que há mais texto */
    white-space: nowrap; /* Impede a quebra de linha */
}

td {
    background-color: #f9fcfa; /* Fundo alternado claro */
}

tr:nth-child(even) td {
    background-color: #e0f2e9; /* Fundo alternado verde claro */
}

tr:hover td {
    background-color: #cce5d9; /* Destaque ao passar o mouse */
}

td:first-child, th:first-child {
    font-weight: bold;
}

/* Largura fixa para o nome dos times */
td:nth-child(2) {
    text-align: left; /* Alinhar o texto à esquerda */
    padding-left: 10px; /* Adicionar espaçamento à esquerda */
}

/* Botões */
button {
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

button:hover {
    background-color: #21633d; /* Verde ainda mais escuro */
}

.button-container {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 20px;
}

/* Ajustes adicionais para os campos de entrada */
.matchup input {
    border: none;
    background: #f4f4f4;
    text-align: center;
    padding: 5px;
    border-radius: 5px;
    width: 100px;
}

.InputGol {
    max-width: 30px; /* Tamanho fixo para os campos de gols */
    text-align: center;
}

.InputPR {
    padding-right: 30px; /* Ajuste no padding */
}

.InputPL {
    padding-left: 30px; /* Ajuste no padding */

/* Alinhamento das Tabelas */
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
    min-height: 80px; /* Definir altura mínima */
    background-color: #e9f5ec; /* Fundo verde claro */
}

.team {
    display: flex;
    justify-content: center;
    width: 45%; /* Definir largura fixa */
    align-items: center;
}

.resultado {
    font-weight: bold;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 10%;
}

.team input {
    border: none;
    background: none;
    text-align: center;
    font-size: 16px;
    width: 100%;
    font-weight: bold;
    padding: 5px;
    box-sizing: border-box; /* Garante que o padding não afete a largura */
}

.team input:focus {
    outline: none; /* Remove o contorno ao focar no campo */
}

/* Adicionar uma borda entre os times na visualização */
.match-container .team {
    border-right: 1px solid #ccc;
}

.match-container .team:last-child {
    border-right: none; /* Remove a borda do último time */
}


</style>
<body>
    <div class="tables-container">
        @foreach ($classificacao->chunk(4) as $grupo)
            <div class="table-group">
                <!-- Exibe o nome do grupo dinamicamente -->
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
</body>

</html>
