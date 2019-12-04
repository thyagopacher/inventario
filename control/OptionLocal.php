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

if(isset($_POST["codcidade"]) && $_POST["codcidade"] != NULL && $_POST["codcidade"] != ""){
    $and .= ' and codlocal in(select codlocal from localcidade where codcidade = '. $_POST["codcidade"].')';
}

$reslocal = $conexao->comando('select codlocal, nome from local where 1 = 1 '.$and.' order by nome');
$qtdlocal = $conexao->qtdResultado($reslocal);
if ($qtdlocal > 0) {
    echo '<option value="">--Selecione--</option>';
    while ($local = $conexao->resultadoArray($reslocal)) {
        echo '<option value="', $local["codlocal"], '">', ($local["nome"]), '</option>';
    }
} else {
    echo '<option value="">--Nada encontrado--</option>';
}