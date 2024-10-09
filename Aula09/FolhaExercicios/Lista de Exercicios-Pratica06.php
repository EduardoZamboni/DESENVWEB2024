<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Compras de Joãozinho</title>
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
    <h1>Compras de Joãozinho</h1>
    <div class="container">
        <form method="post">
            <input type="number" name="maca" placeholder="Maçã (R$/kg)" required>
            <input type="number" name="melancia" placeholder="Melancia (R$/kg)" required>
            <input type="number" name="laranja" placeholder="Laranja (R$/kg)" required>
            <input type="number" name="repolho" placeholder="Repolho (R$/kg)" required>
            <input type="number" name="cenoura" placeholder="Cenoura (R$/kg)" required>
            <input type="number" name="batatinha" placeholder="Batatinha (R$/kg)" required>
            <input type="number" name="quantidade" placeholder="Quantidade (kg)" required>
            <input type="submit" value="Calcular Total">
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $precos = [
                'maca' => $_POST['maca'],
                'melancia' => $_POST['melancia'],
                'laranja' => $_POST['laranja'],
                'repolho' => $_POST['repolho'],
                'cenoura' => $_POST['cenoura'],
                'batatinha' => $_POST['batatinha']
            ];
            $quantidade = $_POST['quantidade'];
            $total = 0;

            foreach ($precos as $preco) {
                $total += $preco * $quantidade;
            }

            $dinheiro = 50.00;

            echo "<div class='resultado'>";
            if ($total < $dinheiro) {
                $restante = $dinheiro - $total;
                echo "<p style='color: blue;'>Você ainda pode gastar R$ $restante</p>";
            } elseif ($total > $dinheiro) {
                $falta = $total - $dinheiro;
                echo "<p style='color: red;'>Faltam R$ $falta</p>";
            } else {
                echo "<p style='color: green;'>Saldo para compras esgotado</p>";
            }
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
