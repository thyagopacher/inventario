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

date_default_timezone_set('America/Sao_Paulo');
$conexao = new Conexao();
$diretoria  = new Diretoria($conexao);

$variables = (strtolower($_SERVER['REQUEST_METHOD']) == 'GET') ? $_GET : $_POST;
foreach ($variables as $key => $value) {
    $diretoria->$key = $value;
}

$msg_retorno = '';
$sit_retorno = true;

$res = $diretoria->excluir();

if ($res === FALSE) {
    $msg_retorno = 'Erro ao excluir diretoria! Causado por:' . mysqli_error($conexao->conexao);
    $sit_retorno = false;
} else {
    $msg_retorno = "Diretoria excluida com sucesso!";
    new Log($conexao, "Diretoria salva: ", $diretoria->nome);
}

echo json_encode(array('mensagem' => $msg_retorno, 'situacao' => $sit_retorno));
