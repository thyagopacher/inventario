<?php

/*
 * @author Thyago Henrique Pacher - thyago.pacher@gmail.com
 */

session_start();
if (!isset($_SESSION)) {
    die(json_encode(array('mensagem' => 'Sua sessão caiu, por favor logue novamente!!!', 'situacao' => false)));
}

function __autoload($class_name) {
    if (file_exists("../model/" . $class_name . '.php')) {
        include "../model/" . $class_name . '.php';
    } elseif (file_exists("../visao/" . $class_name . '.php')) {
        include "../visao/" . $class_name . '.php';
    } elseif (file_exists("./" . $class_name . '.php')) {
        include "./" . $class_name . '.php';
    }
}

$conexao = new Conexao();
$produto = new Produto($conexao);
$modificacaoObjeto = '';
if (isset($_POST["codproduto"]) && $_POST["codproduto"] != NULL && $_POST["codproduto"] != "") {
    $produtoAnterior = $conexao->comandoArray("select * from produto where codproduto = {$_POST["codproduto"]}");
}

$variables = (strtolower($_SERVER['REQUEST_METHOD']) == 'GET') ? $_GET : $_POST;
foreach ($variables as $key => $value) {
    $produto->$key = $value;
    if (strstr($key, 'Arquivo') == FALSE && strstr($key, 'campo_produto') == FALSE 
            && $produto->$key != NULL && trim($produto->$key) != "" 
            && $produtoAnterior[$key] != $produto->$key && $key != "btSalvar"
            && isset($_POST["codproduto"]) && $_POST["codproduto"] != NULL && $_POST["codproduto"] != "") {
        if(strstr($key, 'cod')){
            $tabelaEstrangeira = str_replace('cod', '', $key);
            if($tabelaEstrangeira == "status"){
                $tabelaEstrangeira = "statusproduto";
            }
            $valorNovo              = $conexao->comandoArray("select nome from {$tabelaEstrangeira} where $key = {$produto->$key}");
            $valorAntigo            = $conexao->comandoArray("select nome from {$tabelaEstrangeira} where $key = {$produtoAnterior[$key]}");
            if($tabelaEstrangeira == "statusproduto"){
                $key = 'status';
            }else{
                $key = $tabelaEstrangeira;
            }
            $produtoAnterior[$key]  = $valorAntigo["nome"];            
            $valorNovoString        = $valorNovo["nome"];            
        }else{
            $valorNovoString = $produto->$key;
        }
        $modificacaoObjeto .= " - Atributo: ".ucfirst($key)." - Valor Antes: $produtoAnterior[$key] - Valor Novo: {$valorNovoString}<br>";
    }
}

$msg_retorno = '';
$sit_retorno = true;

if (!isset($_POST["codestado"]) || $_POST["codestado"] == NULL || $_POST["codestado"] == "") {
    die(json_encode(array('mensagem' => 'Por favor defina estado!', 'situacao' => false)));
}
if (!isset($_POST["codcidade"]) || $_POST["codcidade"] == NULL || $_POST["codcidade"] == "") {
    die(json_encode(array('mensagem' => 'Por favor defina cidade!', 'situacao' => false)));
}

if (isset($produto->codproduto) && $produto->codproduto != NULL && $produto->codproduto != "") {
    $res = $produto->atualizar();
} else {
    
    $categoriap     = $conexao->comandoArray('select nome from categoriaproduto where codcategoria = '. $produto->codcategoria);
    $localp         = $conexao->comandoArray('select nome from local where codlocal = '. $produto->codlocal);
    $estadop        = $conexao->comandoArray('select nome from estado where codestado = '. $produto->codestado);
    $cidadep        = $conexao->comandoArray('select nome from cidade where codcidade = '. $produto->codcidade);
    $departamentop  = $conexao->comandoArray('select nome from departamento where coddepartamento = '. $produto->coddepartamento);
    
    $modificacaoObjeto = "Produto salvo: Categoria: {$categoriap["nome"]} - Local: {$localp["nome"]} - Estado: {$estadop["nome"]} - Cidade: {$cidadep["cidade"]} - Departamento: {$departamentop["nome"]}";
    $res = $produto->inserir();
    $produto->codproduto = mysqli_insert_id($conexao->conexao);
}

if ($res == FALSE) {
    $msg_retorno = 'Erro ao salvar produto! Causado por:' . mysqli_error($conexao->conexao);
    $sit_retorno = false;
} else {
    $msg_retorno = "Cadastro salvo com sucesso!";

    $resatributo = $conexao->comando('select ac.codatributo, atributo.tipo, atributo.nome as atributo 
    from atributocategoria as ac
    inner join atributo on atributo.codatributo = ac.codatributo
    where 1 = 1 
    and ac.codcategoria = ' . $produto->codcategoria . ' 
    order by ac.codatributo');
    $qtdatributo = $conexao->qtdResultado($resatributo);
    if ($qtdatributo > 0) {
        $modificacaoAtributos = '';
        while ($atributo = $conexao->resultadoArray($resatributo)) {
            $vp = new ValorProduto($conexao);
            $vp->codatributo = $atributo["codatributo"];
            $vp->codproduto = $produto->codproduto;
            if (isset($atributo["tipo"]) && $atributo["tipo"] != NULL && $atributo["tipo"] == "file") {
                $upload = new Upload($_FILES['campo_produto' . $atributo["codatributo"]], null, 'campo_produto' . $atributo["codatributo"]);
                if ($upload->erro == '') {
                    $vp->valor = $upload->nome_final;
                } else {
                    die(json_encode(array('mensagem' => 'Erro fazer upload. Causado por: ' . $upload->erro, 'situacao' => false)));
                }
            } else {
                $vp->valor = $_POST["campo_produto" . $atributo["codatributo"]];
            }
            if($atributo["tipo"] == "date" && strstr($vp->valor, '/')){
                $vp->valor = implode("-", array_reverse(explode("/", $vp->valor)));
            }
            $vp->valor = $conexao->trataString($vp->valor);
            $sql = 'select codvalor, valor from valorproduto where codproduto = ' . $produto->codproduto . ' and codatributo = ' . $atributo["codatributo"];
            $valorp = $conexao->comandoArray($sql);
            if (isset($valorp["codvalor"]) && $valorp["codvalor"] != NULL && $valorp["codvalor"] != "") {
                $vp->codvalor = $valorp["codvalor"];
                if ($vp->valor != NULL && $vp->valor != "" && $vp->valor != $valorp["valor"]) {
                    $modificacaoAtributos .= " - Atributo: {$atributo["atributo"]} - Valor Antes: {$valorp["valor"]} - Valor Novo: {$vp->valor}<br>";
                }
                $resInserir = $vp->atualizar();
            } else {
                $resInserir = $vp->inserir();
            }
            if ($resInserir == FALSE) {
                die(json_encode(array('mensagem' => 'Erro ao inserir campos adicionais. Causado por: ' . mysqli_error($conexao->conexao), 'situacao' => false)));
            }
        }
    }

    $log = new Log($conexao, $modificacaoObjeto . $modificacaoAtributos, $produto->codproduto);
}

echo json_encode(array('mensagem' => $msg_retorno, 'situacao' => $sit_retorno));
