<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class StatusProduto{
    
    public $codstatus;
    public $nome;
    public $dtcadastro;
    public $codfuncionario;
    public $cor;
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
        return $this->conexao->inserir('statusproduto', $this);
    }

    public function atualizar(){
        return $this->conexao->atualizar('statusproduto', $this);
    }

    public function procurarCodigo(){
        return $this->conexao->procurarCodigo('statusproduto', $this);
    }
    
    public function excluir(){
        return $this->conexao->excluir('statusproduto', $this);
    }

}