<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Soma de Três Valores</title>
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
        input[type="number"] {
            display: block;
            margin: 10px auto;
        }
        .resultado {
            margin-top: 20px;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <h1>Soma de Três Valores</h1>
    <div class="container">
        <form method="post">
            <input type="number" name="valor1" placeholder="Valor 1" required>
            <input type="number" name="valor2" placeholder="Valor 2" required>
            <input type="number" name="valor3" placeholder="Valor 3" required>
            <input type="submit" value="Calcular">
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $valor1 = $_POST['valor1'];
            $valor2 = $_POST['valor2'];
            $valor3 = $_POST['valor3'];
            $soma = $valor1 + $valor2 + $valor3;

            echo "<div class='resultado'>";
            if ($valor1 > 10) {
                echo "<p style='color: blue;'>Resultado: $soma</p>";
            } elseif ($valor2 < $valor3) {
                echo "<p style='color: green;'>Resultado: $soma</p>";
            } elseif ($valor3 < $valor1 && $valor3 < $valor2) {
                echo "<p style='color: red;'>Resultado: $soma</p>";
            }
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
