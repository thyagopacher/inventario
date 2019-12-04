<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class AtributoCategoria{
    
    public $codac;
    public $codcategoria;
    public $codatributo;
    public $dtcadastro;
    public $codfuncionario;
    public $obrigatorio;
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
        return $this->conexao->inserir('atributocategoria', $this);
    }

    public function atualizar(){
        return $this->conexao->atualizar('atributocategoria', $this);
    }

    public function procurarCodigo(){
        return $this->conexao->procurarCodigo('atributocategoria', $this);
    }
    
    public function excluir(){
        return $this->conexao->excluir('atributocategoria', $this);
    }

}