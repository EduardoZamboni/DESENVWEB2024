<?php
session_start();
require_once '../src/funcoes.php';

global $conn;

if (!isset($_SESSION['indice']) || $_SESSION['indice'] < 0) {
    $_SESSION['indice'] = 0; 
}

$total_perguntas_ativas = contar_perguntas_ativas();

if ($_SESSION['indice'] >= $total_perguntas_ativas) {
    header("Location: obrigado.php"); 
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pergunta_id = $_POST['pergunta_id'];
    $resposta = $_POST['resposta'];
    $feedback = $_POST['feedback'] ?? null;

    processar_feedback_respostas($pergunta_id, $resposta, $feedback);

    $_SESSION['indice']++;

    if ($_SESSION['indice'] >= $total_perguntas_ativas) {
        header("Location: obrigado.php");
        exit;
    }
}

$pergunta = get_uma_pergunta($_SESSION['indice']);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliação de Atendimento</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>

<header>
    <img src="../HRAV-LOGO.png" alt="Logo HRAV">
</header>

<div class="container-avaliacao">
    <h1>Avaliação de Atendimento - Hospital</h1>

    <form method="POST" action="index.php">
        <?php
        if ($pergunta) {
            echo "<div class='pergunta'>";
            echo "<h3>" . htmlspecialchars($pergunta['texto_pergunta']) . "</h3>";
            echo "<input type='hidden' name='pergunta_id' value='" . htmlspecialchars($pergunta['id']) . "'>";
            exibir_escala_resposta($pergunta['id']);
            echo "</div>";
        } else {
            echo "<p style='color:red;'>Nenhuma pergunta ativa encontrada.</p>";
        }
        ?>

        <div class="feedback">
            <label for="feedback">Feedback adicional (opcional):</label><br>
            <textarea id="feedback" name="feedback" rows="4" cols="50" placeholder="Digite seu feedback aqui..."></textarea>
        </div>

        <button type="submit">Enviar Avaliação</button>
    </form>

    <div class="rodape">
        Sua avaliação espontânea é anônima, nenhuma informação pessoal é solicitada ou armazenada.
    </div>
</div>

<a href="admin.php" class="admin-button">Admin</a>

</body>
</html>
