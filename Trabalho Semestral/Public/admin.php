<?php
session_start();
require_once '../src/funcoes.php'; 

if (!existe_admin()) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['new_username']) && isset($_POST['new_password'])) {
        $new_username = $_POST['new_username'];
        $new_password = $_POST['new_password'];

        cadastrar_admin($new_username, $new_password);
        echo "<p style='color:green;'>Administrador cadastrado com sucesso! Agora você pode fazer login.</p>";
    }

    ?>
    <link rel="stylesheet" href="../public/css/admin.css">
    <h2>Cadastre um Administrador</h2>
    <form method="POST" action="admin.php">
        <label for="new_username">Usuário:</label>
        <input type="text" name="new_username" required><br>
        <label for="new_password">Senha:</label>
        <input type="password" name="new_password" required><br>
        <button type="submit">Cadastrar</button>
    </form>
    <?php
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (processar_login($username, $password)) {
        header('Location: admin.php');
        exit;
    } else {
        echo "<p style='color:red;'>Login inválido! Tente novamente.</p>";
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    processar_logout();
}

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    ?>
    <link rel="stylesheet" href="../public/css/admin.css">
        <h2>Login</h2>
        <form method="POST" action="admin.php" class="login-container">
             <label for="username">Usuário:</label>
             <input type="text" name="username" required><br>
             <label for="password">Senha:</label>
             <input type="password" name="password" required><br>
             <button type="submit">Entrar</button>
        </form>
        <a href="index.php">Voltar para avaliação</a>
    <?php
    exit;
}
?>
<link rel="stylesheet" href="../public/css/admin.css">
<h2>Bem-vindo, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>

<h3>Painel de Gerenciamento de Perguntas</h3>

<form method="POST" action="admin.php">
    <h4>Adicionar ou Editar Pergunta</h4>
    <label for="pergunta_id">ID da Pergunta (deixe em branco para adicionar nova):</label>
    <input type="text" name="pergunta_id" placeholder="ID para editar"><br>

    <label for="texto_pergunta">Texto da Pergunta:</label><br>
    <textarea name="texto_pergunta" rows="3" cols="50" required></textarea><br>

    <label for="status">Status:</label>
    <select name="status" required>
        <option value="ativa">Ativa</option>
        <option value="inativa">Inativa</option>
    </select><br>

    <button type="submit" name="acao" value="salvar">Salvar Pergunta</button>
</form>

<form method="POST" action="admin.php">
    <h4>Excluir Pergunta</h4>
    <label for="pergunta_id_excluir">ID da Pergunta:</label>
    <input type="text" name="pergunta_id_excluir" required><br>
    <button type="submit" name="acao" value="excluir">Excluir Pergunta</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['acao'] === 'salvar') {
        $pergunta_id = $_POST['pergunta_id'] ?? null;
        $texto_pergunta = $_POST['texto_pergunta'] ?? null;
        $status = $_POST['status'] ?? null;

        if ($texto_pergunta && $status) {
            if (empty($pergunta_id)) {
                adicionar_pergunta($texto_pergunta, $status);
                echo "<p style='color:green;'>Pergunta adicionada com sucesso!</p>";
            } else {
                editar_pergunta($pergunta_id, $texto_pergunta, $status);
                echo "<p style='color:green;'>Pergunta editada com sucesso!</p>";
            }
        } else {
            echo "<p style='color:red;'>Preencha todos os campos obrigatórios!</p>";
        }
    } elseif ($_POST['acao'] === 'excluir') {
        $pergunta_id_excluir = $_POST['pergunta_id_excluir'] ?? null;
        if ($pergunta_id_excluir) {
            excluir_pergunta($pergunta_id_excluir);
            echo "<p style='color:green;'>Pergunta excluída com sucesso!</p>";
        } else {
            echo "<p style='color:red;'>Informe o ID da pergunta para excluir!</p>";
        }
    }
}
?>

<h3>Lista de Perguntas</h3>
<?php
$perguntas = listar_perguntas();
if ($perguntas) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Texto</th><th>Status</th></tr>";
    foreach ($perguntas as $pergunta) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($pergunta['id']) . "</td>";
        echo "<td>" . htmlspecialchars($pergunta['texto_pergunta']) . "</td>";
        echo "<td>" . htmlspecialchars($pergunta['status']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>Nenhuma pergunta cadastrada.</p>";
}
?>

<div class="logout-container">
    <a href="admin.php?action=logout" class="sair-btn">Sair</a>
</div>
