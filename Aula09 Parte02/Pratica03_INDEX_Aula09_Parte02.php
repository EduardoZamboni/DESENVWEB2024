<?php

require_once("Pratica03_FUNCOES_Aula09_Parte02.php");

$notas = [8, 7.5, 6, 9, 10];
$faltas = [1, 0, 1, 0, 0];

$media = calcularMedia($notas);
$statusNota = verificarAprovacaoPorNota($media);
$frequencia = calcularFrequencia($faltas);
$statusFrequencia = verificarAprovacaoPorFrequencia($frequencia);

echo "Média das notas: " . number_format($media, 2) . "\n";
echo "Status de aprovação por nota: " . $statusNota . "\n";
echo "Frequência: " . number_format($frequencia, 2) . "%\n";
echo "Status de aprovação por frequência: " . $statusFrequencia . "\n";

?>
