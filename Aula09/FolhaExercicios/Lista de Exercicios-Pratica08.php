<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Parcelas Paulinho</title>
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
    <h1>Parcelas Paulinho</h1>
    <div class="container">
        <?php
        $valorVista = 8654.00;
        $parcelas = [24, 36, 48, 60];
        $taxaInicial = 1.5 / 100;

        echo "<div class='resultado'>";
        foreach ($parcelas as $n) {
            $taxa = $taxaInicial + (($n - 24) * 0.005);
            $juros = $valorVista * $taxa * $n;
            $valorTotal = $valorVista + $juros;
            $valorParcela = $valorTotal / $n;

            echo "<p>Valor da parcela para $n vezes: R$ " . number_format($valorParcela, 2, ',', '.') . "</p>";
        }
        echo "</div>";
        ?>
    </div>
</body>
</html>
