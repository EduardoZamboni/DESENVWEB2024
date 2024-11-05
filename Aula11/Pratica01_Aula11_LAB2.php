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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['pesnome'];
    $sobrenome = $_POST['pessobrenome'] ?? null;
    $email = $_POST['pesemail'] ?? null;
    $password = password_hash($_POST['pesspassword'], PASSWORD_DEFAULT); 
    $cidade = $_POST['pescidade'] ?? null;
    $estado = $_POST['pesestado'] ?? null;

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
    <input type="password" id="password" name="pesspassword"><br>

    <label for="cidade">Cidade:</label>
    <input type="text" id="cidade" name="pescidade" maxlength="100"><br>

    <label for="estado">Estado:</label>
    <input type="text" id="estado" name="pesestado" maxlength="2"><br>

    <button type="submit">Cadastrar</button>
</form>

<hr>

<h2>Lista de Pessoas Cadastradas</h2>

<?php

$conn = conectarBanco();

$query = "SELECT pescodigo, pesnome, pessobrenome, pesemail, pescidade, pesestado, createdat FROM TBPESSOA";
$result = pg_query($conn, $query);

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
