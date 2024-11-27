<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Times</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f8f4;
            margin: 20px;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #2c6e49;
            margin-bottom: 20px;
        }

        .tables-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .table-group {
            width: 45%;
            min-width: 300px;
            background: #e9f5ec;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 15px;
        }

        table {
            width: 100%;
            text-align: center;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #2c6e49;
            color: white;
            text-transform: uppercase;
        }

        td {
            background-color: #f9fcfa;
        }

        tr:nth-child(even) td {
            background-color: #e0f2e9;
        }

        tr:hover td {
            background-color: #cce5d9;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
        }

        .btn-standard {
            background-color: #007BFF;
        }

        .btn-standard:hover {
            background-color: #0056b3;
        }

        .btn-random {
            background-color: #28a745;
        }

        .btn-random:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <h1>Adicionar 32 Times aos Grupos</h1>

    <form action="{{ route('adicionar.times') }}" method="POST">
        @csrf
        <div class="tables-container">
            <!-- Grupos -->
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

        <!-- Botões -->
        <div class="button-container">
            <button type="submit" name="modo" value="padrão" class="btn-standard">Adicionar Times</button>
            <button type="submit" name="modo" value="random" class="btn-random">Randomizar Tabela</button>
        </div>
    </form>
</body>

</html>
