<?php
$host = "localhost";
$dbname = "HRAV-base";
$user = "postgres";
$password = "postgres";

$conn = pg_connect("host=$host dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Falha na conexão: " . pg_last_error());
}

function get_uma_pergunta($indice) {
    global $conn;
    $sql = "SELECT id, texto_pergunta FROM perguntas WHERE status = 'ativa' ORDER BY id LIMIT 1 OFFSET $1";
    $result = pg_query_params($conn, $sql, array($indice));

    if ($result && pg_num_rows($result) > 0) { 
        return pg_fetch_assoc($result);
    } else {
        return null; 
    }
}

function exibir_escala_resposta($pergunta_id) {
    echo "<div class='resposta'>";
    for ($i = 0; $i <= 10; $i++) {
        echo "<input type='radio' id='resposta_$i' name='resposta' value='$i' required>";
        echo "<label for='resposta_$i'>$i</label>";
    }
    echo "<input type='hidden' name='pergunta_id' value='$pergunta_id'>";
    echo "</div>";
}

function processar_feedback_respostas($pergunta_id, $resposta, $feedback) {
    global $conn;
    $resposta_value = is_array($resposta) ? $resposta[0] : $resposta;

    $sql = "INSERT INTO avaliacoes (pergunta_id, resposta, feedback) 
            VALUES ($1, $2, $3)";
    $params = array($pergunta_id, $resposta_value, $feedback);

    $result = pg_query_params($conn, $sql, $params);

    if (!$result) {
        die("Erro ao inserir resposta e feedback: " . pg_last_error());
    }
}

function existe_admin() {
    global $conn;
    $sql = "SELECT COUNT(*) AS total FROM administradores";
    $result = pg_query($conn, $sql);

    if ($result) {
        $row = pg_fetch_assoc($result);
        return (int)$row['total'] > 0;
    } else {
        die("Erro ao verificar administradores: " . pg_last_error($conn));
    }
}

function cadastrar_admin($username, $password) {
    global $conn;
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); 
    $sql = "INSERT INTO administradores (username, password) VALUES ($1, $2)";
    $result = pg_query_params($conn, $sql, [$username, $hashed_password]);

    if (!$result) {
        die("Erro ao cadastrar administrador: " . pg_last_error($conn));
    }
}

function processar_login($username, $password) {
    global $conn;
    $sql = "SELECT password FROM administradores WHERE username = $1";
    $result = pg_query_params($conn, $sql, [$username]);

    if ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username; 
            return true;
        }
    }
    return false;
}

function processar_logout() {
    session_destroy();
    header('Location: admin.php');
    exit;
}

function adicionar_pergunta($texto_pergunta, $status) {
    global $conn;
    $sql = "INSERT INTO perguntas (texto_pergunta, status) VALUES ($1, $2)";
    pg_query_params($conn, $sql, [$texto_pergunta, $status]) 
        or die("Erro ao adicionar pergunta: " . pg_last_error($conn));
}

function editar_pergunta($id, $texto_pergunta, $status) {
    global $conn;
    $sql = "UPDATE perguntas SET texto_pergunta = $1, status = $2 WHERE id = $3";
    pg_query_params($conn, $sql, [$texto_pergunta, $status, $id]) 
        or die("Erro ao editar pergunta: " . pg_last_error($conn));
}

function excluir_pergunta($id) {
    global $conn;

    $sql_delete_avaliacoes = "DELETE FROM avaliacoes WHERE pergunta_id = $1";
    pg_query_params($conn, $sql_delete_avaliacoes, [$id]) 
        or die("Erro ao excluir avaliações: " . pg_last_error($conn));

    $sql_delete_pergunta = "DELETE FROM perguntas WHERE id = $1";
    pg_query_params($conn, $sql_delete_pergunta, [$id]) 
        or die("Erro ao excluir pergunta: " . pg_last_error($conn));
}


function listar_perguntas() {
    global $conn;
    $sql = "SELECT * FROM perguntas ORDER BY id";
    $result = pg_query($conn, $sql);
    return $result ? pg_fetch_all($result) : [];
}

function contar_perguntas_ativas() {
    global $conn;
    $sql = "SELECT COUNT(*) AS total FROM perguntas WHERE status = 'ativa'";
    $result = pg_query($conn, $sql);
    
    if ($result) {
        $row = pg_fetch_assoc($result);
        return (int)$row['total'];
    } else {
        die("Erro na contagem de perguntas: " . pg_last_error($conn));
    }
}
?>
