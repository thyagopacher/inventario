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
$ac  = new AtributoCategoria($conexao);

$variables = (strtolower($_SERVER['REQUEST_METHOD']) == 'GET') ? $_GET : $_POST;
foreach ($variables as $key => $value) {
    $ac->$key = $value;
}

$msg_retorno = '';
$sit_retorno = true;

if(!isset($ac->codatributo) || $ac->codatributo == NULL || $ac->codatributo == ""){
    die(json_encode(array('mensagem' => 'Por favor escolha o atributo!!!', 'situacao' => false)));
}  
if((!isset($ac->codcategoria) || $ac->codcategoria == NULL || $ac->codcategoria == "")
        && (!isset($_POST["adicionarcategorias"]) || $_POST["adicionarcategorias"] == NULL || $_POST["adicionarcategorias"] == "")){
    die(json_encode(array('mensagem' => 'Por favor escolha a categoria!!!', 'situacao' => false)));
}  

if(isset($ac->codac) && $ac->codac != NULL && $ac->codac != ""){
    $res = $ac->atualizar();
}else{
    
    if(isset($_POST["adicionarcategorias"]) && $_POST["adicionarcategorias"] != NULL && $_POST["adicionarcategorias"] == "s"){
        $rescategoria = $conexao->comando('select codcategoria from categoriaproduto where codcategoria not in(select codcategoria from atributocategoria where codatributo = '.$_POST["codatributo"].')');
        $qtdcategoria = $conexao->qtdResultado($rescategoria);
        if($qtdcategoria > 0){
            while($categoria = $conexao->resultadoArray($rescategoria)){
                $ac = new AtributoCategoria($conexao);
                $ac->codatributo  = $_POST["codatributo"];
                $ac->codcategoria = $categoria["codcategoria"];
                $res = $ac->inserir();
                if($res == FALSE){
                    die(json_encode(array('mensagem' => 'Erro ao salvar atributo! Erro causado por: '. mysqli_error($conexao->conexao), 'situacao' => false)));
                }
            }
        }
    }else{
        $acp = $conexao->comandoArray("select codac from atributocategoria where codatributo = {$ac->codatributo} and codcategoria = {$ac->codcategoria}");
        if(isset($acp["codac"]) && $acp["codac"] != NULL && $acp["codac"] != ""){
            die(json_encode(array('mensagem' => 'Atributo ja inserido para essa categoria!!!', 'situacao' => false)));
        }
        $res = $ac->inserir();
    }
}

if ($res === FALSE) {
    $msg_retorno = 'Erro ao salvar atributo categoria! Causado por:' . mysqli_error($conexao->conexao);
    $sit_retorno = false;
} else {
    $msg_retorno = "Atributo categoria salvo com sucesso!";
}

echo json_encode(array('mensagem' => $msg_retorno, 'situacao' => $sit_retorno));
