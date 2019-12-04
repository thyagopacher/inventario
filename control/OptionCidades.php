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

if(isset($_POST["codestado"]) && $_POST["codestado"] != NULL && $_POST["codestado"] != ""){
    $and .= ' and codestado = '. $_POST["codestado"];
}

$rescidade = $conexao->comando('select codcidade, nome from cidade where 1 = 1 '.$and.' order by nome');
$qtdcidade = $conexao->qtdResultado($rescidade);
if ($qtdcidade > 0) {
    echo '<option value="">--Selecione--</option>';
    while ($cidade = $conexao->resultadoArray($rescidade)) {
        echo '<option value="', $cidade["codcidade"], '">', ($cidade["nome"]), '</option>';
    }
} else {
    echo '<option value="">--Nada encontrado--</option>';
}