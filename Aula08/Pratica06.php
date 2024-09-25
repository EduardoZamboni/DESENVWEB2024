<?php
   $dados = [
       ['Disciplina' => 'Matemática', 'Faltas' => 5, 'Média' => 8.5],
       ['Disciplina' => 'Português', 'Faltas' => 2, 'Média' => 9],
       ['Disciplina' => 'Geografia', 'Faltas' => 10, 'Média' => 6],
       ['Disciplina' => 'Educação Física', 'Faltas' => 2, 'Média' => 8]
   ];
   
   function gerarTabela($dados) {
       echo "<table>";
       
       echo "<tr>";
       foreach ($dados[0] as $chave => $valor) {
           echo "<th>" . htmlspecialchars($chave) . "</th>";
       }
       echo "</tr>";
       
       foreach ($dados as $linha) {
           echo "<tr>";
           foreach ($linha as $valor) {
               echo "<td>" . htmlspecialchars($valor) . "</td>";
           }
           echo "</tr>";
       }
       
       echo "</table>";
   }
   
?>
   
   <!DOCTYPE html>
   <html lang="pt-br">
   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Tabela de Disciplinas</title>
       <style>
           table {
               width: 30%;
               border-collapse: collapse;
               margin: 20px 0;
               font-size: 18px;
               text-align: left;
           }
           th, td {
               padding: 12px 35px;
           }
           th {
               background-color: #FFB74D; 
               color: white;
           }
           tr:nth-child(even) {
               background-color: #FFF3E0;
           }
           tr:nth-child(odd) {
               background-color: white; 
           }
           tr:hover {
               background-color: #FFE0B2; 
           }
           td {
               border: 1px solid #ddd;
           }
       </style>
   </head>
   <body>
       <?php
           gerarTabela($dados);
       ?>
   </body>
   </html>
   
?>
