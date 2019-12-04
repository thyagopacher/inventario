<?php

/* 
 * @author Thyago Henrique Pacher - thyago.pacher@gmail.com
 */

include '../model/Conexao.php';
include 'Email.php';

$email = new Email();
$conexao = new Conexao();
$mensagemInicial = '';
if(!isset($_POST["email"]) || $_POST["email"] == NULL || $_POST["email"] == ""){
    die(json_encode(array('mensagem' => 'Por favor preencha e-mail!', 'situacao' => false)));
}elseif(strlen($_POST["email"]) < 5){
   die(json_encode(array('mensagem' => 'E-mail deve ter pelo menos 5 letras, por favor confira!', 'situacao' => false)));
}elseif(strpos($_POST["email"], '@') == FALSE){
   die(json_encode(array('mensagem' => 'E-mail deve ter @, por favor confira!', 'situacao' => false)));
}else{
    $separado_email = explode('@', $_POST["email"]);
    if(count($separado_email) != 2){
        die(json_encode(array('mensagem' => 'E-mail deve uma parte antes do @ e outra depois!', 'situacao' => false)));
    }elseif(strlen($separado_email[0]) < 3){
        die(json_encode(array('mensagem' => 'Primeira parte do e-mail deve ter pelo menos 3 letras!', 'situacao' => false)));
    }elseif(strlen($separado_email[1]) < 3){
        die(json_encode(array('mensagem' => 'Segunda parte do e-mail deve ter pelo menos 3 letras!', 'situacao' => false)));
    }
}
if(!isset($_POST["nome"]) || $_POST["nome"] == NULL || $_POST["nome"] == ""){
    die(json_encode(array('mensagem' => 'Por favor preencha e-mail!', 'situacao' => false)));
}else{
    $mensagemInicial .= "Nome: {$_POST["nome"]}<br>";
}
if(isset($_POST["telefone"]) && $_POST["telefone"] != NULL && $_POST["telefone"] != ""){
    $mensagemInicial .= "Telefone: {$_POST["telefone"]}<br>";
}
if(!isset($_POST["mensagem"]) || $_POST["mensagem"] == NULL || $_POST["mensagem"] == ""){
    die(json_encode(array('mensagem' => 'Por favor preencha mensagem!', 'situacao' => false)));
}

$empresap = $conexao->comandoArray('select email1, razao from empresa where codempresa = 1');

$email->mensagem   = 'Informações de contato: <br>';
$email->mensagem  .= $mensagemInicial;
$email->mensagem  .= 'Mensagem:'.$_POST["mensagem"]. '<br>';
$email->assunto    = "Contato enviado site: ". date("d/m/Y H:i:s");
$email->para_email = $empresap["email1"];
$email->para       = $empresap["razao"];
$resEnvioEmail     = $email->envia();
if($resEnvioEmail == FALSE){
    die(json_encode(array('mensagem' => 'Erro ao enviar e-mail!', 'situacao' => false)));
}else{
    die(json_encode(array('mensagem' => 'E-mail enviado com sucesso! Espere um retorno nosso em breve!', 'situacao' => true)));
}