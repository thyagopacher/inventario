<?php

/* 
 * @author Thyago Henrique Pacher - thyago.pacher@gmail.com
 */

Class Empresa{
    
    public $codempresa;
    public $razao;
    public $telefone1;
    public $telefone2;
    public $dtcadastro;
    public $logo;
    public $cep;
    public $tipologradouro;
    public $logradouro;
    public $numero;
    public $bairro;
    public $cidade;
    public $estado;
    public $email1;

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
        return $this->conexao->inserir('empresa', $this);
    }

    public function atualizar(){
        return $this->conexao->atualizar('empresa', $this);
    }

    public function procurarCodigo(){
        return $this->conexao->procurarCodigo('empresa', $this);
    }
    
    public function excluir(){
        return $this->conexao->excluir('empresa', $this);
    }

}