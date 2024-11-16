<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            text-align: center;
            font-family: 'Arial', sans-serif;
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
            width: 350px; 
        }
        input {
            margin: 15px 0;
            padding: 12px;
            width: 100%;
            background-color: #444444;
            color: white;
            border: 2px solid #ff4444;
            border-radius: 0; 
            font-size: 16px;
            box-sizing: border-box; 
        }
        input:focus {
            border-color: #ff6666;
            background-color: #555555;
        }
        input[type="submit"] {
            background-color: #ff4444;
            color: white;
            cursor: pointer;
            font-weight: bold;
        }
        input[type="submit"]:hover {
            background-color: #ff6666;
        }
        .erro {
            color: #ff4444;
            font-size: 14px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <?php if (isset($erro)): ?>
            <p class="erro"><?= $erro ?></p>
        <?php endif; ?>
        <p>Use o login <strong>usuario</strong> e a senha <strong>senha123</strong> para acessar.</p>
        <form method="POST" style="width: 100%;">
            <input type="text" name="login" placeholder="Login" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <input type="submit" value="Entrar">
        </form>
    </div>
</body>
</html>
