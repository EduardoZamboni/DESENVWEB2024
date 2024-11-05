<?php

$arquivo = 'dados.txt';

if (file_exists($arquivo)) {

    $conteudo = file_get_contents($arquivo);

    echo "<h2>Conteúdo do arquivo 'dados.txt'</h2>";
    echo "<pre>" . htmlspecialchars($conteudo) . "</pre>";


    $dadosSerializados = serialize($conteudo);

    $arquivoDestino = 'dados2.txt';

    if (file_put_contents($arquivoDestino, $dadosSerializados) !== false) {
        echo "<p>Os dados foram serializados e gravados em 'dados2.txt' com sucesso!</p>";
    } else {
        echo "<p>Erro ao gravar os dados no arquivo 'dados2.txt'.</p>";
    }
} else {

    echo "<p>O arquivo 'dados.txt' não foi encontrado.</p>";
}
?>
