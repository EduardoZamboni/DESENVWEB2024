<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro e Listagem de Pessoas</title>
</head>
<body>

<?php

function conectarBanco() {
    $host = "localhost"; 
    $dbname = "Aula11"; 
    $user = "postgres";
    $password = "postgres"; 

    $conn = pg_connect("host=$host dbname=$dbname user=$user password=$password");

    if (!$conn) {
        die("Erro ao conectar ao banco de dados.");
    }
    return $conn;
}

// Função para sanitizar dados de entrada
function sanitizar($data) {
    return htmlspecialchars(trim($data));
}

// Função para validar email
function validarEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Bloco de inserção de dados ao banco
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cadastrar'])) {
    $nome = sanitizar($_POST['pesnome']);
    $sobrenome = sanitizar($_POST['pessobrenome'] ?? '');
    $email = sanitizar($_POST['pesemail'] ?? '');
    $cidade = sanitizar($_POST['pescidade'] ?? '');
    $estado = sanitizar($_POST['pesestado'] ?? '');

    // Validar o email
    if (!validarEmail($email)) {
        echo "<p>Email inválido. Por favor, insira um email válido.</p>";
        return;
    }

    // Sanitizar e hashear a senha
    $password = password_hash($_POST['pesspassword'], PASSWORD_DEFAULT);

    $conn = conectarBanco();

    $query = "INSERT INTO TBPESSOA (pesnome, pessobrenome, pesemail, pesspassword, pescidade, pesestado) 
              VALUES ($1, $2, $3, $4, $5, $6)";

    $params = [$nome, $sobrenome, $email, $password, $cidade, $estado];
    $result = pg_query_params($conn, $query, $params);

    if ($result) {
        echo "<p>Dados inseridos com sucesso!</p>";
    } else {
        echo "<p>Erro ao inserir dados.</p>";
    }

    pg_close($conn);
}

// Lógica para pesquisa
$searchTerm = '';
if (isset($_GET['search'])) {
    $searchTerm = sanitizar($_GET['search']);
}
?>

<h2>Cadastro de Pessoa</h2>
<form action="" method="POST">
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="pesnome" required maxlength="150"><br>

    <label for="sobrenome">Sobrenome:</label>
    <input type="text" id="sobrenome" name="pessobrenome" maxlength="150"><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="pesemail" maxlength="150"><br>

    <label for="password">Senha:</label>
    <input type="password" id="password" name="pesspassword" required><br>

    <label for="cidade">Cidade:</label>
    <input type="text" id="cidade" name="pescidade" maxlength="100"><br>

    <label for="estado">Estado:</label>
    <input type="text" id="estado" name="pesestado" maxlength="2"><br>

    <button type="submit" name="cadastrar">Cadastrar</button>
</form>

<hr>

<h2>Lista de Pessoas Cadastradas</h2>

<form action="" method="GET">
    <label for="search">Buscar por Nome:</label>
    <input type="text" id="search" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>" maxlength="150">
    <button type="submit">Buscar</button>
</form>

<?php

$conn = conectarBanco();

$query = "SELECT pescodigo, pesnome, pessobrenome, pesemail, pescidade, pesestado, createdat FROM TBPESSOA";
if ($searchTerm) {
    $query .= " WHERE pesnome ILIKE $1"; 
    $params = ["%$searchTerm%"];
} else {
    $params = [];
}

$result = pg_query_params($conn, $query, $params);

if (!$result) {
    echo "<p>Erro ao buscar dados.</p>";
} else {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Sobrenome</th>
                <th>Email</th>
                <th>Cidade</th>
                <th>Estado</th>
                <th>Data de Criação</th>
            </tr>";

    while ($row = pg_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['pescodigo']) . "</td>";
        echo "<td>" . htmlspecialchars($row['pesnome']) . "</td>";
        echo "<td>" . htmlspecialchars($row['pessobrenome']) . "</td>";
        echo "<td>" . htmlspecialchars($row['pesemail']) . "</td>";
        echo "<td>" . htmlspecialchars($row['pescidade']) . "</td>";
        echo "<td>" . htmlspecialchars($row['pesestado']) . "</td>";
        echo "<td>" . htmlspecialchars($row['createdat']) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
}

pg_close($conn);
?>

</body>
</html>
