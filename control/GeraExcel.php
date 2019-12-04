<?php

set_time_limit(0);
// Determina que o arquivo é uma planilha do Excel
header('Content-Type: application/vnd.ms-excel');

// Força o download do arquivo
header("Content-type: application/force-download");

//limpando espaços no gerador de excel
$nome = remover_caracter(str_replace("-", " ", $nome));

// Seta o nome do arquivo
header("Content-Disposition: attachment; filename={$nome}.xls");
header('Cache-Control: max-age=0');
header("Pragma: no-cache");

// Imprime o conteúdo da nossa tabela no arquivo que será gerado
echo preg_replace('/\s+/', ' ', $_POST["html"]);
 
function remover_caracter($string) {
    $string = str_replace("ç", "c", $string);
    $string = str_replace("Ç", "C", $string);
    $string = str_replace("ã", "a", $string);
    $string = str_replace("á", "a", $string);
    $string = str_replace("é", "a", $string);
    $string = str_replace("õ", "o", $string);
    $string = str_replace("ó", "o", $string);
    $string = preg_replace("/[áàâãä]/", "a", $string);
    $string = preg_replace("/[ÁÀÂÃÄ]/", "A", $string);
    $string = preg_replace("/[éèê]/", "e", $string);
    $string = preg_replace("/[ÉÈÊ]/", "E", $string);
    $string = preg_replace("/[íì]/", "i", $string);
    $string = preg_replace("/[ÍÌ]/", "I", $string);
    $string = preg_replace("/[óòôõö]/", "o", $string);
    $string = preg_replace("/[ÓÒÔÕÖ]/", "O", $string);
    $string = preg_replace("/[úùü]/", "u", $string);
    $string = preg_replace("/[ÚÙÜ]/", "U", $string);

    $string = preg_replace("/[][><}{)(:;,!?*%~^`&#@]/", '', $string);
    $string = preg_replace("/ /", "_", $string);
    return $string;
}

?>