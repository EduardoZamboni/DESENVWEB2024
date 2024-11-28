<?php
function db_connect() {
    $host = 'localhost';
    $port = '5432';
    $dbname = 'hrav_db';
    $user = 'seu_usuario';
    $password = 'sua_senha';
    
    $conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
    
    if (!$conn) {
        die("Erro ao conectar ao banco de dados.");
    }
    
    return $conn;
}
?>