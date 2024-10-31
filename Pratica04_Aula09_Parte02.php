<?php

function calcularValorFinal($valor, $desconto) {
    if (!is_numeric($valor) || !is_numeric($desconto)) {
        throw new InvalidArgumentException("Os valores devem ser numéricos.");
    }

    if ($valor < 0 || $desconto < 0) {
        throw new Exception("Os valores não podem ser negativos.");
    }

    $valorFinal = $valor - $desconto;

    if ($valorFinal < 0) {
        throw new Exception("O valor final não pode ser negativo.");
    }

    return $valorFinal;
}

try {
    $valor = isset($_REQUEST['valor']) ? $_REQUEST['valor'] : 0;
    $desconto = isset($_REQUEST['desconto']) ? $_REQUEST['desconto'] : 0;

    $valorFinal = calcularValorFinal($valor, $desconto);
    echo "Valor final: R$ " . number_format($valorFinal, 2, ',', '.');

} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
} catch (InvalidArgumentException $e) {
    echo "Erro: " . $e->getMessage();
}

?>
