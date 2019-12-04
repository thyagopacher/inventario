<?php
    session_start();
    function __autoload($class_name) {
        if(file_exists("../model/".$class_name . '.php')){
            include "../model/".$class_name . '.php';
        }elseif(file_exists("../visao/".$class_name . '.php')){
            include "../visao/".$class_name . '.php';
        }elseif(file_exists("./".$class_name . '.php')){
            include "./".$class_name . '.php';
        }
    }

    $pessoa   = new Pessoa();
    
    $variables = (strtolower($_SERVER["REQUEST_METHOD"]) == "GET") ? $_GET : $_POST;
    foreach($variables as $key => $value){
        $pessoa->$key = str_replace("select", "", str_replace("insert", "", str_replace("update", "", str_replace("or 1 = 1", "", $value))));
    }
     
    $pessoa2 = $pessoa->login();

    if(!isset($pessoa2["codpessoa"]) || $pessoa2["codpessoa"] == NULL || $pessoa2["codpessoa"] == ""){
        die(json_encode(array('mensagem' => 'Erro ao entrar, e-mail ou senha inválidos!!!', 'situacao' => false)));
    }else{
        
        $_SESSION["codpessoa"]  = $pessoa2["codpessoa"];
        $_SESSION["nome"]       = $pessoa2["nome"];
        $_SESSION["imagem"]     = $pessoa2["imagem"];    
        $_SESSION["codnivel"]   = $pessoa2["codnivel"];    
        $_SESSION["codempresa"] = $pessoa2["codempresa"];
        $_SESSION["dtcadastro"] = $pessoa2["dtcadastro"];
        die(json_encode(array('mensagem' => 'Logado com sucesso!!!', 'situacao' => true, 'nome' => $pessoa2["nome"], 
            'dtcadastro' => $pessoa2["dtcadastro"], 'codpessoa' => $pessoa2["codpessoa"], 'imagem' => $pessoa2["foto"])));
    }    