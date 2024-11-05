<?php
// Função para ler o arquivo JSON
function lerArquivoJSON() {
    $arquivo = 'pessoas.json';
    if (file_exists($arquivo)) {
        $conteudo = file_get_contents($arquivo);
        return json_decode($conteudo, true); // Retorna os dados como um array
    }
    return [];
}

// Função para salvar os dados no arquivo JSON
function salvarArquivoJSON($dados) {
    $arquivo = 'pessoas.json';
    $dadosExistentes = lerArquivoJSON();
    
    // Limitar a 10 pessoas, se houver mais
    if (count($dadosExistentes) >= 10) {
        array_shift($dadosExistentes); // Remover a primeira pessoa (FIFO) se exceder 10
    }
    
    // Adicionar os novos dados
    array_push($dadosExistentes, $dados);
    
    // Gravar no arquivo
    file_put_contents($arquivo, json_encode($dadosExistentes, JSON_PRETTY_PRINT));
}

// Bloco de inserção de dados
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cadastrar'])) {
    $nome = $_POST['pesnome'];
    $sobrenome = $_POST['pessobrenome'] ?? null;
    $email = $_POST['pesemail'] ?? null;
    $password = password_hash($_POST['pesspassword'], PASSWORD_DEFAULT);
    $cidade = $_POST['pescidade'] ?? null;
    $estado = $_POST['pesestado'] ?? null;

    // Estrutura dos dados a serem salvos
    $dadosPessoa = [
        'pesnome' => $nome,
        'pessobrenome' => $sobrenome,
        'pesemail' => $email,
        'pesspassword' => $password,
        'pescidade' => $cidade,
        'pesestado' => $estado,
        'createdat' => date("Y-m-d H:i:s")
    ];

    // Salvar dados no arquivo JSON
    salvarArquivoJSON($dadosPessoa);

    echo "<p>Dados inseridos com sucesso!</p>";
}

// Lógica para pesquisa
$searchTerm = '';
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
}

// Ler dados do arquivo JSON
$pessoas = lerArquivoJSON();

// Filtrar pessoas pelo nome, se houver um termo de busca
if ($searchTerm) {
    $pessoas = array_filter($pessoas, function ($pessoa) use ($searchTerm) {
        return stripos($pessoa['pesnome'], $searchTerm) !== false; // Pesquisa sem diferenciar maiúsculas de minúsculas
    });
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro e Listagem de Pessoas</title>
</head>
<body>

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

    <button type="submit" name="cadastrar">Cadastrar</button>
</form>

<hr>

<h2>Lista de Pessoas Cadastradas</h2>

<!-- Formulário de busca -->
<form action="" method="GET">
    <label for="search">Buscar por Nome:</label>
    <input type="text" id="search" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>" maxlength="150">
    <button type="submit">Buscar</button>
</form>

<?php
if ($pessoas) {
    echo "<table border='1'>
            <tr>
                <th>Nome</th>
                <th>Sobrenome</th>
                <th>Email</th>
                <th>Cidade</th>
                <th>Estado</th>
                <th>Data de Criação</th>
            </tr>";

    // Exibe os dados de cada pessoa
    foreach ($pessoas as $pessoa) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($pessoa['pesnome']) . "</td>";
        echo "<td>" . htmlspecialchars($pessoa['pessobrenome']) . "</td>";
        echo "<td>" . htmlspecialchars($pessoa['pesemail']) . "</td>";
        echo "<td>" . htmlspecialchars($pessoa['pescidade']) . "</td>";
        echo "<td>" . htmlspecialchars($pessoa['pesestado']) . "</td>";
        echo "<td>" . htmlspecialchars($pessoa['createdat']) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>Não há pessoas cadastradas.</p>";
}
?>

</body>
</html>
