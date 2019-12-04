<?php

/* 
 * @author Thyago Henrique Pacher - thyago.pacher@gmail.com
 */
ini_set('display_errors', 0);
ini_set('display_startup_erros', 0);

include '../model/Conexao.php';
include 'Email.php';

$email = new Email();
$conexao = new Conexao();
$mensagemInicial = '';
if(!isset($_POST["login"]) || $_POST["login"] == NULL || $_POST["login"] == ""){
    die(json_encode(array('mensagem' => 'Por favor preencha e-mail ou login!', 'situacao' => false)));
}

$pessoap = $conexao->comandoArray('select email, nome, senha from pessoa where (email = "'. $conexao->trataString($_POST["login"]). '" or login = "'. $conexao->trataString($_POST["login"]).'") and email <> ""');

$email->mensagem   = 'Informações de senha: <br>';
$email->mensagem  .= "Sua senha é: ". base64_decode($pessoap["senha"]);
$email->assunto    = "Recuperação de senha: ". date("d/m/Y H:i:s");
$email->para_email = $pessoap["email"];
$email->para       = $pessoap["nome"];
$resEnvioEmail     = $email->envia();
if($resEnvioEmail == FALSE){
    die(json_encode(array('mensagem' => 'Erro ao enviar e-mail!', 'situacao' => false)));
}else{
    die(json_encode(array('mensagem' => 'Senha enviada para seu e-mail!', 'situacao' => true)));
}