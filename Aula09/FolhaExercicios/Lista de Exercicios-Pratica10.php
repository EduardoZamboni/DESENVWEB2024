<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Estrutura da Pasta</title>
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
            box-sizing: border-box; 
        }
    </style>
</head>
<body>
    <h1>Estrutura da Pasta</h1>
    <div class="container">
        <?php
        $pasta = array(
            "bsn" => array(
                "3a Fase" => array(
                    "desenvWeb",
                    "bancoDados 1",
                    "engSoft 1"
                ),
                "4a Fase" => array(
                    "Intro Web",
                    "bancoDados 2",
                    "engSoft 2"
                )
            )
        );

        function criarArvore($array, $nivel = 0) {
            foreach ($array as $chave => $valor) {
                echo str_repeat("-", $nivel) . " ";
                
                if (is_array($valor)) {
                    echo $chave . "<br>";
                    criarArvore($valor, $nivel + 2);
                } else {
                    echo $valor . "<br>";
                }
            }
        }

        criarArvore($pasta);
        ?>
    </div>
</body>
</html>
