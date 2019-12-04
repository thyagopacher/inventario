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
$atributo  = new Atributo($conexao);

$variables = (strtolower($_SERVER['REQUEST_METHOD']) == 'GET') ? $_GET : $_POST;
foreach ($variables as $key => $value) {
    $atributo->$key = $value;
}

$msg_retorno = '';
$sit_retorno = true;

if(isset($atributo->tipo) && $atributo->tipo != NULL && $atributo->tipo == "varchar"
        && (!isset($atributo->tamanho) || $atributo->tamanho == NULL || $atributo->tamanho == "")){
    die(json_encode(array('mensagem' => 'Tamanho é obrigatório para varchar!!!', 'situacao' => false)));
}

if(isset($atributo->codatributo) && $atributo->codatributo != NULL && $atributo->codatributo != ""){
    $res = $atributo->atualizar();
}else{
    $res = $atributo->inserir();
}

if ($res === FALSE) {
    $msg_retorno = 'Erro ao salvar atributo! Causado por:' . mysqli_error($conexao->conexao);
    $sit_retorno = false;
} else {
    $msg_retorno = "Atributo salvo com sucesso!";
    $log = new Log($conexao, "Atributo salvo: {$atributo->nome} - tamanho: {$atributo->tamanho} - tipo: {$atributo->tipo} - mascara: {$atributo->mascara} - lista: {$atributo->lista}");
}

echo json_encode(array('mensagem' => $msg_retorno, 'situacao' => $sit_retorno));
