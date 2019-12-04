<?php

/* 
 * @author Thyago Henrique Pacher - thyago.pacher@gmail.com
 */

Class Produto{
    
    public $codproduto;
    public $nome;
    public $dtcadastro;
    public $codcidade;
    public $codestado;
    public $codlocal;
    public $coddepartamento;
    
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
        if(!isset($this->codfuncionario) || $this->codfuncionario == NULL || $this->codfuncionario == ""){
            $this->codfuncionario = $_SESSION["codpessoa"];
        } 
        return $this->conexao->inserir('produto', $this);
    }

    public function atualizar(){
        if(!isset($this->IND_ATIVO) || $this->IND_ATIVO == NULL || $this->IND_ATIVO == ""){
            $this->IND_ATIVO = 1;
        }        
        return $this->conexao->atualizar('produto', $this);
    }

    public function procurarCodigo(){
        return $this->conexao->procurarCodigo('produto', $this);
    }
    
    public function excluir(){
        return $this->conexao->excluir('produto', $this);
    }

}