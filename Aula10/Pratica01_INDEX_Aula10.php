<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'] ?? '';
    $senha = $_POST['senha'] ?? '';

    // Simulação de validação de usuário
    if ($login == 'usuario' && $senha == 'senha123') {
        $_SESSION['login'] = $login;
        $_SESSION['senha'] = $senha;
        $_SESSION['inicio_sessao'] = date('Y-m-d H:i:s');
        $_SESSION['ultima_requisicao'] = $_SESSION['inicio_sessao'];
        
        header("Location: dashboard.php");
        exit();
    } else {
        $erro = "Login ou senha inválidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
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
        input {
            margin: 10px 0;
            padding: 10px;
            width: 100%;
        }
        .erro {
            color: red;
        }
    </style>
</head>
<body>
    <h1>Login</h1>
    <div class="container">
        <?php if (isset($erro)): ?>
            <p class="erro"><?= $erro ?></p>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="login" placeholder="Login" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <input type="submit" value="Entrar">
        </form>
    </div>
</body>
</html>
