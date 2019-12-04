<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class Pagina{
    
    public $codpagina;
    public $nome;
    public $link;
    public $titulo;
    public $codmodulo;
    public $icone;
    public $codpai;
    public $comcodigo;
    
    private $conexao;
    
    public function __construct($conexao) {
        $this->conexao = $conexao;
    }
    
    public function __destruct() {
        unset($this);
    }     

    public function inserir(){
        if(!isset($this->dtcadastro) || $this->dtcadastro == NULL || $this->dtcadastro == ""){
            $this->dtcadastro = date("Y-m-d H:i:s");
        }          
        if(!isset($this->codpai) || $this->codpai == NULL || $this->codpai == ""){
            $this->codpai = '0';
        }          
        if(!isset($this->icone) || $this->icone == NULL || $this->icone == ""){
            $this->icone = ' ';
        }          
        return $this->conexao->inserir('pagina', $this);
    }

    public function atualizar(){
        return $this->conexao->atualizar('pagina', $this);
    }

    public function excluir(){
        return $this->conexao->excluir('pagina', $this);
    }

    public function procurarCodigo(){
        return $this->conexao->procurarCodigo('pagina', $this);
    }

}