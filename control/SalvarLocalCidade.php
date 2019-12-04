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
$localCidade  = new LocalCidade($conexao);

$variables = (strtolower($_SERVER['REQUEST_METHOD']) == 'GET') ? $_GET : $_POST;
foreach ($variables as $key => $value) {
    $localCidade->$key = $value;
}

$msg_retorno = '';
$sit_retorno = true;

if(isset($localCidade->codlc) && $localCidade->codlc != NULL && $localCidade->codlc != ""){
    $res = $localCidade->atualizar();
}else{
    $res = $localCidade->inserir();
}

if ($res === FALSE) {
    $msg_retorno = 'Erro ao salvar local cidade! Causado por:' . mysqli_error($conexao->conexao);
    $sit_retorno = false;
} else {
    $msg_retorno = "Local cidade salvo com sucesso!";
//    $log = new Log($conexao, "Local cidade salvo: {$localCidade->nome}");
}

echo json_encode(array('mensagem' => $msg_retorno, 'situacao' => $sit_retorno));
