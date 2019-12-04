<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class Atributo{
    
    public $codatributo;
    public $nome;
    public $tipo;
    public $tamanho;
    public $mascara;
    public $lista;
    public $ordem;
    public $dtcadastro;
    public $codfuncionario;
    public $filtro;
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
        return $this->conexao->inserir('atributo', $this);
    }

    public function atualizar(){
        return $this->conexao->atualizar('atributo', $this);
    }

    public function procurarCodigo(){
        return $this->conexao->procurarCodigo('atributo', $this);
    }
    
    public function excluir(){
        return $this->conexao->excluir('atributo', $this);
    }

}