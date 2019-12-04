<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class Departamento{
    
    public $coddepartamento;
    public $nome;
    public $coddiretoria;
    public $dtcadastro;
    public $codfuncionario;
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
        return $this->conexao->inserir('departamento', $this);
    }

    public function atualizar(){
        return $this->conexao->atualizar('departamento', $this);
    }

    public function procurarCodigo(){
        return $this->conexao->procurarCodigo('departamento', $this);
    }
    
    public function excluir(){
        return $this->conexao->excluir('departamento', $this);
    }

}