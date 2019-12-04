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

$conexao = new Conexao();
$status  = new StatusProduto($conexao);

$variables = (strtolower($_SERVER['REQUEST_METHOD']) == 'GET') ? $_GET : $_POST;
foreach ($variables as $key => $value) {
    $status->$key = $value;
}

$msg_retorno = '';
$sit_retorno = true;

$qtdStatus = $conexao->comandoArray('select count(1) as qtd from produto where codstatus = '. $status->codstatus);
if(isset($qtdStatus["qtd"]) && $qtdStatus["qtd"] != NULL && $qtdStatus["qtd"] > 0){
    die(json_encode(array('mensagem' => "Não pode excluir status pois tem {$qtdStatus["qtd"]} usando ela!!!", 'situacao' => false)));
}

$res = $status->excluir();

if ($res === FALSE) {
    $msg_retorno = 'Erro ao excluir status! Causado por:' . mysqli_error($conexao->conexao);
    $sit_retorno = false;
} else {
    $msg_retorno = "Status excluido com sucesso!";
}

echo json_encode(array('mensagem' => $msg_retorno, 'situacao' => $sit_retorno));
