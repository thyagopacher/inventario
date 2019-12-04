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
$categoria  = new CategoriaProduto($conexao);

$variables = (strtolower($_SERVER['REQUEST_METHOD']) == 'GET') ? $_GET : $_POST;
foreach ($variables as $key => $value) {
    $categoria->$key = $value;
}

$msg_retorno = '';
$sit_retorno = true;

if (isset($_FILES['imagem'])) {
    $upload = new Upload($_FILES['imagem']);
    if ($upload->erro == '') {
        $categoria->imagem = $upload->nome_final;
    }
}

if(isset($categoria->codcategoria) && $categoria->codcategoria != NULL && $categoria->codcategoria != ""){
    $res = $categoria->atualizar();
}else{
    $res = $categoria->inserir();
}

if ($res === FALSE) {
    $msg_retorno = 'Erro ao salvar pessoa! Causado por:' . mysqli_error($conexao->conexao);
    $sit_retorno = false;
} else {
    $msg_retorno = "Categoria produto salvo com sucesso!";
    $log = new Log($conexao, "Categoria produto salvo: {$categoria->nome}");
}

echo json_encode(array('mensagem' => $msg_retorno, 'situacao' => $sit_retorno));
