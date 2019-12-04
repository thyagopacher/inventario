<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class Pessoa{
    public $codpessoa;
    public $nome;
    public $login;
    public $email;
    public $senha;
    public $dtcadastro;
    public $foto;
    private $conexao;
    
    public function __construct() {
        $this->conexao = new Conexao();
    }
    
    public function __destruct() {
        unset($this);
    }     

    public function inserir(){
        if(!isset($this->dtcadastro) || $this->dtcadastro == NULL || $this->dtcadastro == ""){
            $this->dtcadastro = date("Y-m-d H:i:s");
        }         
        if(!isset($this->codfuncionario) || $this->codfuncionario == NULL || $this->codfuncionario == ""){
            $this->codfuncionario = $_SESSION["codpessoa"];
        }     
        if(!isset($this->codempresa) || $this->codempresa == NULL || $this->codempresa == ""){
            $this->codempresa = $_SESSION["codempresa"];
        }     
        return $this->conexao->inserir('pessoa', $this);
    }

    public function atualizar(){
        if(isset($this->senha) && $this->senha != NULL && $this->senha != ""){
            $this->senha = base64_encode($this->senha);
        }           
        return $this->conexao->atualizar('pessoa', $this);
    }

    public function excluir(){
        return $this->conexao->excluir('pessoa', $this);
    }

    public function procurarCodigo(){
        return $this->conexao->procurarCodigo('pessoa', $this);
    }

    public function login(){
        $this->login = addslashes($this->login);
        $sql = 'select codpessoa, nome, imagem, dtcadastro, codnivel, codempresa 
        from pessoa 
        where (email = "'. $this->login. '" or login = "'. $this->login. '") 
        and senha = "'. base64_encode($this->senha). '"';
        return $this->conexao->comandoArray($sql);
    }
    

}