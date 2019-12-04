<?php

/* 
 * @author Thyago Henrique Pacher - thyago.pacher@gmail.com
 */

session_start();
if(!isset($_SESSION)){
    die(json_encode(array('mensagem' => 'Sua sessão caiu, por favor logue novamente!!!', 'situacao' => false)));
}  

function __autoload($class_name) {
    if (file_exists("../model/" . $class_name . '.php')) {
        include "../model/" . $class_name . '.php';
    } elseif (file_exists("../visao/" . $class_name . '.php')) {
        include "../visao/" . $class_name . '.php';
    } elseif (file_exists("./" . $class_name . '.php')) {
        include "./" . $class_name . '.php';
    }
}

$conexao      = new Conexao();
$valorProduto = new ValorProduto($conexao);

$variables = (strtolower($_SERVER['REQUEST_METHOD']) == 'GET') ? $_GET : $_POST;
foreach ($variables as $key => $value) {
    $valorProduto->$key = $value;
}

$msg_retorno = '';
$sit_retorno = true;

$valorp = $conexao->comandoArray("select valor from valorproduto where codvalor = {$valorProduto->codvalor}");

$res = $valorProduto->excluir();

if ($res === FALSE) {
    $msg_retorno = 'Erro ao excluir valor produto! Causado por:' . mysqli_error($conexao->conexao);
    $sit_retorno = false;
} else {
    $msg_retorno = "Valor Produto excluido com sucesso!";
    unlink('../arquivos/'. $valorp["valor"]);
}

echo json_encode(array('mensagem' => $msg_retorno, 'situacao' => $sit_retorno));
