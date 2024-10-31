<?php
session_start();

// Atualiza a data/hora da última requisição
if (isset($_SESSION['login'])) {
    $_SESSION['ultima_requisicao'] = date('Y-m-d H:i:s');
} else {
    header("Location: index.php");
    exit();
}

$tempoSessao = time() - $_SESSION['inicio_sessao'];
$tempoSessaoFormatado = gmdate("H:i:s", $tempoSessao);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel de Controle</title>
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
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <h1>Painel de Controle</h1>
    <div class="container">
        <p>Login: <?= $_SESSION['login'] ?></p>
        <p>Data/hora início da sessão: <?= $_SESSION['inicio_sessao'] ?></p>
        <p>Data/hora da última requisição: <?= $_SESSION['ultima_requisicao'] ?></p>
        <p>Tempo de sessão: <?= $tempoSessaoFormatado ?></p>
        <a href="logout.php">Sair</a>
    </div>
</body>
</html>
