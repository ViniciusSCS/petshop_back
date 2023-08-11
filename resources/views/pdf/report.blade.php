<!DOCTYPE html>
<html>

<head>
    <title>PawControll</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            background-color: #f2f2f2;
            padding: 10px;
        }

        .content {
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>{{ $title }}</h1>
    </div>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Idade</th>
                <th>Especie - Raça</th>
                <th>Peso</th>
                <th>Sexo</th>
                <!-- Adicione mais colunas conforme necessário -->
            </tr>
        </thead>
        <tbody>
            @foreach($pets as $pet)
            <tr>
                <td>{{ $pet->nome }}</td>
                <td>{{ $pet->idade }}</td>
                <td>{{ $pet->especie->descricao }} - {{ $pet->raca->descricao }}</td>
                <td>{{ $pet->peso }}</td>
                <td>{{ $pet->sexo }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>