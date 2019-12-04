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

if(isset($_POST["codcategoria"]) && $_POST["codcategoria"] != NULL && $_POST["codcategoria"] != ""){
    $and .= ' and codcategoria = '. $_POST["codcategoria"];
}

$array_cidade = null;
$resatributo  = $conexao->comando('select codatributo, obrigatorio from atributocategoria where 1 = 1 '.$and.' order by codatributo');
$qtdatributo  = $conexao->qtdResultado($resatributo);
if ($qtdatributo > 0) {
    while ($atributo = $conexao->resultadoArray($resatributo)) {
        $array_cidade[] = array('codatributo' => $atributo["codatributo"], 'obrigatorio' => $atributo["obrigatorio"]);
    }
}

die(json_encode($array_cidade));