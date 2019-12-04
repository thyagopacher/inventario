<?php

ini_set('display_errors', 0 );
error_reporting(0);

session_start();
//validação caso a sessão caia
if (!isset($_SESSION)) {
    die("<script>alert('Sua sessão caiu, por favor logue novamente!!!');window.close();</script>");
}

header ('Content-type: text/html; charset=UTF-8');

include "../model/Conexao.php";
$conexao = new Conexao();

if (isset($_POST["email"]) && $_POST["email"] != NULL && $_POST["email"] != "") {
    $and .= " and pessoa.email like '%{$_POST["email"]}%'";
}
if (isset($_POST["data1"]) && $_POST["data1"] != NULL && $_POST["data1"] != "") {
    if (strpos($_POST["data1"], "/")) {
        $data1 = implode("-", array_reverse(explode("/", $_POST["data1"])));
    } else {
        $data1 = $_POST["data1"];
    }
    $and .= " and pessoa.dtcadastro >= '{$data1}'";
}
if (isset($_POST["data2"]) && $_POST["data2"] != NULL && $_POST["data2"] != "") {
    if (strpos($_POST["data2"], "/")) {
        $data1 = implode("-", array_reverse(explode("/", $_POST["data2"])));
    } else {
        $data1 = $_POST["data2"];
    }
    $and .= " and pessoa.dtcadastro <= '{$_POST["data2"]}'";
}
if (isset($_POST["cpf"]) && $_POST["cpf"] != NULL && $_POST["cpf"] != "") {
    $cpf_limpo = str_replace(".", "", str_replace("-", "", $_POST["cpf"]));
    $and .= " and (pessoa.cpf = '{$_POST["cpf"]}' or pessoa.cpf = '{$cpf_limpo}')";
}
if (isset($_POST["nome"]) && $_POST["nome"] != NULL && $_POST["nome"] != "") {
    $and .= " and pessoa.nome like '%{$_POST["nome"]}%'";
}

if (isset($_POST["codcategoria"]) && $_POST["codcategoria"] != NULL && $_POST["codcategoria"] != "") {
    $and .= " and pessoa.codcategoria = '{$_POST["codcategoria"]}'";
}
if (isset($_POST["codstatus"]) && $_POST["codstatus"] != NULL && $_POST["codstatus"] != "") {
    $and .= " and pessoa.codstatus = '{$_POST["codstatus"]}'";
}

if (isset($_POST["sexo"]) && $_POST["sexo"] != NULL && $_POST["sexo"] != "") {
    $and .= " and pessoa.sexo = '{$_POST["sexo"]}'";
}
if (isset($_POST["rg"]) && $_POST["rg"] != NULL && $_POST["rg"] != "") {
    $and .= " and pessoa.rg = '{$_POST["rg"]}'";
}

if (isset($_POST["estado"]) && $_POST["estado"] != NULL && $_POST["estado"] != "") {
    $and .= " and pessoa.estado = '{$_POST["estado"]}'";
}
if (isset($_POST["email"]) && $_POST["email"] != NULL && $_POST["email"] != "") {
    $and .= " and pessoa.email = '{$_POST["email"]}'";
}

if (isset($_POST["ordem"])) {
    if ($_POST["ordem"] == "1") {
        $orderby = " order by pessoa.nome";
    } elseif ($_POST["ordem"] == "2") {
        $orderby = " order by pessoa.dtcadastro";
    }
}

$sql = 'select pessoa.codpessoa, pessoa.nome, pessoa.cpf, 
    pessoa.email, DATE_FORMAT(pessoa.dtcadastro, "%d/%m/%Y") as data, pessoa.senha, pessoa.status,
    nivel.nome as nivel
    from pessoa 
    inner join nivel on nivel.codnivel = pessoa.codnivel 
    where 1 = 1 ' . $and . $orderby;
$res = $conexao->comando($sql)or die('Erro no comando: <pre>' . $sql . '</pre>');
$qtd = $conexao->qtdResultado($res);
if ($qtd > 0) {
    $html = "";
    $nome = 'Relatório Clientes';
    $html .= '<table class="responstable" style="font-size: 12px">';
    $html .= '<thead>';
    $html .= '<tr>';
    $html .= '<th style="width: 180px;">Nome</th>';
    $html .= '<th>Nivel</th>';
    $html .= '<th>Status</th>';
    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';
    while ($pessoa = $conexao->resultadoArray($res)) {
        $html .= '<tr>';
        $html .= '<td>' . ($pessoa["nome"]) . '</td>';
        $html .= '<td style="text-align: center;">' . $pessoa["nivel"] . '</td>';
        $html .= '<td style="text-align: center;">' . $pessoa["status"] . '</td>';
        $html .= '</tr>';
    }
    $html .= '</tbody>';
    $html .= '</table>';

    $_POST["html"] = preg_replace('/\s+/', ' ', str_replace("> <", "><", $html));
    $paisagem = "sim";
    if (isset($_POST["tipo"]) && $_POST["tipo"] == "xls") {
        include "./GeraExcel.php";
    } else {
        include "./GeraPdf.php";
    }
} else {
    echo '<script>alert("Sem pessoa encontrada!");window.close();</script>';
}
