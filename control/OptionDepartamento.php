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

if(isset($_POST["codcidade"]) && $_POST["codcidade"] != NULL && $_POST["codcidade"] != ""){
    $and .= ' and coddepartamento in(select coddepartamento from cidade where codcidade = '. $_POST["codcidade"].')';
}

$sql             = 'select coddepartamento, nome from departamento where 1 = 1 '.$and.' order by nome';
$resdepartamento = $conexao->comando($sql);
$qtddepartamento = $conexao->qtdResultado($resdepartamento);
if ($qtddepartamento > 0) {
    echo '<option value="">--Selecione--</option>';
    while ($departamento = $conexao->resultadoArray($resdepartamento)) {
        echo '<option value="', $departamento["coddepartamento"], '">', ($departamento["nome"]), '</option>';
    }
} else {
    echo '<option value="">--Nada encontrado--</option>';
}