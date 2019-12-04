<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class Local{
    
    public $codlocal;
    public $dtcadastro;
    public $codfuncionario;
    public $nome;
    private $conexao;
    
    public function __construct($conn) {
        $this->conexao = $conn;
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
        return $this->conexao->inserir('local', $this);
    }

    public function atualizar(){
        return $this->conexao->atualizar('local', $this);
    }

    public function procurarCodigo(){
        return $this->conexao->procurarCodigo('local', $this);
    }
    
    public function excluir(){
        return $this->conexao->excluir('local', $this);
    }

}