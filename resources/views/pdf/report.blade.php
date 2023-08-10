<!DOCTYPE html>
<html>

<head>
    <title>Relatório em PDF</title>
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
    <div class="content">
        <p>Este é um exemplo de relatório em PDF gerado usando o Laravel 8 e o pacote dompdf.</p>
        <p>Você pode personalizar o conteúdo deste relatório de acordo com suas necessidades.</p>
    </div>
</body>

</html>