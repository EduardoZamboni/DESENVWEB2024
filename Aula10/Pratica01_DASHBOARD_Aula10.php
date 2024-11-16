<?php
session_start();

date_default_timezone_set('America/Sao_Paulo');

if (!isset($_SESSION['login']) || !isset($_SESSION['inicio_sessao'])) {
    echo "<script>alert('Os dados da sessão foram perdidos.');</script>";
    header("Location: Pratica01_INDEX_Aula10.php");
    exit();
}

if (!isset($_COOKIE['user_data'])) {
    echo "<script>alert('Cookie de dados do usuário não encontrado.');</script>";
}

$_SESSION['ultima_requisicao'] = date('Y-m-d H:i:s');

$tempoSessao = time() - strtotime($_SESSION['inicio_sessao']);
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
            background-color: #2c2c2c; 
            color: white; 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; 
            margin: 0;
        }
        h1 {
            font-size: 36px;
            color: #ff4444;
        }
        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #333333; 
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.6);
            width: 400px; 
        }
        p {
            margin: 10px 0;
            font-size: 16px;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #ff4444;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        a:hover {
            background-color: #ff6666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Painel de Controle</h1>
        <p><strong>Login:</strong> <?= $_SESSION['login'] ?></p>
        <p><strong>Data/hora início da sessão:</strong> <?= $_SESSION['inicio_sessao'] ?></p>
        <p><strong>Data/hora da última requisição:</strong> <?= $_SESSION['ultima_requisicao'] ?></p>
        <p><strong>Tempo de sessão:</strong> <?= $tempoSessaoFormatado ?></p>
        <a href="Pratica01_LOGOUT_Aula10.php">Sair</a>
    </div>
</body>
</html>
