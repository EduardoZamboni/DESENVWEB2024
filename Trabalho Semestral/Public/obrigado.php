<?php
session_start();
$_SESSION['indice'] = 0; 
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agradecimento</title>
    <link rel="stylesheet" href="../public/css/obrigado.css"> 
    <script>
        setTimeout(function() {
            window.location.href = "index.php";
        }, 1000); 
    </script>
</head>
<body>
<div class="agradecimento-box">
    <img src="../HRAV-LOGO.png" alt="Logo HRAV">
    <h1>Agradecimento</h1>
    <p>O Hospital Regional Alto Vale (HRAV) agradece sua resposta, pois ela nos ajuda a melhorar continuamente nossos serviços.</p>

    <a href="index.php">Voltar para avaliação</a>
</div>

</body>
</html>
