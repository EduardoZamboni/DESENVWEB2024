<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Juros Mariazinha</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0; 
        }
        .container {
            display: inline-block;
            background-color: #add8e6; 
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-top: 20px;
            width: 300px; 
            height: auto; 
            box-sizing: border-box; 
        }
        .resultado {
            margin-top: 20px;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <h1>Juros Mariazinha</h1>
    <div class="container">
        <?php
        $valorAVista = 22500.00;
        $parcelas = 60;
        $valorParcela = 489.65;
        $totalFinanciado = $valorParcela * $parcelas;
        $juros = $totalFinanciado - $valorAVista;

        echo "<div class='resultado'>";
        echo "<p>Valor gasto em juros: R$ $juros</p>";
        echo "</div>";
        ?>
    </div>
</body>
</html>
