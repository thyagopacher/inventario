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
$estado  = new Estado($conexao);

$variables = (strtolower($_SERVER['REQUEST_METHOD']) == 'GET') ? $_GET : $_POST;
foreach ($variables as $key => $value) {
    $estado->$key = $value;
}

$msg_retorno = '';
$sit_retorno = true;

if(isset($estado->codestado) && $estado->codestado != NULL && $estado->codestado != ""){
    $res = $estado->atualizar();
}else{
    $res = $estado->inserir();
}

if ($res === FALSE) {
    $msg_retorno = 'Erro ao salvar estado! Causado por:' . mysqli_error($conexao->conexao);
    $sit_retorno = false;
} else {
    $msg_retorno = "Estado salvo com sucesso!";
    $log = new Log($conexao, "Estado salvo: {$estado->nome}");
}

echo json_encode(array('mensagem' => $msg_retorno, 'situacao' => $sit_retorno));
