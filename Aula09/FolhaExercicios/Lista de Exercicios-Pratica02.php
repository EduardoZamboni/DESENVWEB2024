<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Divisível por 2</title>
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
    <h1>Verificar se é divisível por 2</h1>
    <div class="container">
        <form method="post">
            <input type="number" name="numero" placeholder="Número" required>
            <input type="submit" value="Verificar">
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $numero = $_POST['numero'];

            echo "<div class='resultado'>";
            if ($numero % 2 == 0) {
                echo "<p style='color: blue;'>Valor divisível por 2</p>";
            } else {
                echo "<p style='color: red;'>O valor não é divisível por 2</p>";
            }
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
