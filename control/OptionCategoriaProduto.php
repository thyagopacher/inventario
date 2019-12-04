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

$rescategoria = $conexao->comando('select codcategoria, nome from categoriaproduto where 1 = 1 '.$and.' order by nome');
$qtdcategoria = $conexao->qtdResultado($rescategoria);
if ($qtdcategoria > 0) {
    echo '<option value="">--Selecione--</option>';
    while ($categoria = $conexao->resultadoArray($rescategoria)) {
        echo '<option value="', $categoria["codcategoria"], '">', ($categoria["nome"]), '</option>';
    }
} else {
    echo '<option value="">--Nada encontrado--</option>';
}