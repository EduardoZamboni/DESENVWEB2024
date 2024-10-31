<?php

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

?>
