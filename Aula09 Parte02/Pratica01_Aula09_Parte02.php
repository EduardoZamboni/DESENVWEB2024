<?php

$notas = [8, 7.5, 6, 9, 10];
$faltas = [1, 0, 1, 0, 0];

function calcularMedia($notas) {
    $soma = array_sum($notas);
    return $soma / count($notas);
}

function verificarAprovacaoPorNota($media) {
    return $media >= 7 ? "Aprovado" : "Reprovado";
}

function calcularFrequencia($faltas) {
    $totalAulas = count($faltas);
    $totalFaltas = array_sum($faltas);
    return (($totalAulas - $totalFaltas) / $totalAulas) * 100;
}

function verificarAprovacaoPorFrequencia($frequencia) {
    return $frequencia > 70 ? "Aprovado" : "Reprovado";
}

$media = calcularMedia($notas);
$statusNota = verificarAprovacaoPorNota($media);
$frequencia = calcularFrequencia($faltas);
$statusFrequencia = verificarAprovacaoPorFrequencia($frequencia);

echo "Média das notas: " . number_format($media, 2) . "\n";
echo "Status de aprovação por nota: " . $statusNota . "\n";
echo "Frequência: " . number_format($frequencia, 2) . "%\n";
echo "Status de aprovação por frequência: " . $statusFrequencia . "\n";

?>
