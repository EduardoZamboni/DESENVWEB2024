<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Área do Quadrado</title>
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
            height: 300px; 
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
    <h1>Cálculo da Área do Quadrado</h1>
    <div class="container">
        <form method="post">
            <label for="lado">Comprimento do lado (m):</label>
            <input type="number" name="lado" id="lado" required>
            <input type="submit" value="Calcular Área">
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $lado = $_POST['lado'];
            $area = $lado * $lado;
            echo "<div class='resultado'>";
            echo "<p>A área do quadrado de lado $lado metros é $area metros quadrados.</p>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
