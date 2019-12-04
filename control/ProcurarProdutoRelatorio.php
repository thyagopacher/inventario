<?php

session_start();
//validação caso a sessão caia
if (!isset($_SESSION)) {
    die("<script>alert('Sua sessão caiu, por favor logue novamente!!!');window.close();</script>");
}
include "../model/Conexao.php";
$conexao = new Conexao();
$and = "";
$innerJoin = "";
$campos = "";

if (isset($_POST["nome"]) && $_POST["nome"] != NULL && $_POST["nome"] != "") {
    $and .= " and produto.nome like '%".$conexao->trataString($_POST["nome"])."%'";
}

//dt cadastro
if (isset($_POST["data1"]) && $_POST["data1"] != NULL && $_POST["data1"] != "") {
    if (strpos($_POST["data1"], "/")) {
        $data1 = implode("-", array_reverse(explode("/", $_POST["data1"])));
    } else {
        $data1 = $_POST["data1"];
    }
    $and .= " and produto.dtcadastro >= '{$data1} 00:00:00'";
}
if (isset($_POST["data2"]) && $_POST["data2"] != NULL && $_POST["data2"] != "") {
    if (strpos($_POST["data2"], "/")) {
        $data1 = implode("-", array_reverse(explode("/", $_POST["data2"])));
    } else {
        $data1 = $_POST["data2"];
    }
    $and .= " and produto.dtcadastro <= '{$data1} 23:59:59'";
}

//dt de compra
if (isset($_POST["dataCompra1"]) && $_POST["dataCompra1"] != NULL && $_POST["dataCompra1"] != "") {
    if (strpos($_POST["dataCompra1"], "/")) {
        $data1 = implode("-", array_reverse(explode("/", $_POST["dataCompra1"])));
    } else {
        $data1 = $_POST["dataCompra1"];
    }
    $and .= " and produto.codproduto in(select codproduto from valorproduto where codatributo = 15 and valor >= '{$data1}')";
}
if (isset($_POST["dataCompra2"]) && $_POST["dataCompra2"] != NULL && $_POST["dataCompra2"] != "") {
    if (strpos($_POST["dataCompra2"], "/")) {
        $data1 = implode("-", array_reverse(explode("/", $_POST["dataCompra2"])));
    } else {
        $data1 = $_POST["dataCompra2"];
    }
    $and .= " and produto.codproduto in(select codproduto from valorproduto where codatributo = 15 and valor <= '{$data1}')";
}

if (isset($_POST["codatributo"]) && $_POST["codatributo"] != NULL && $_POST["codatributo"] != "") {
    $and .= " and produto.codproduto in(select codproduto from valorproduto where codatributo = {$_POST["codatributo"]})";
}

if (isset($_POST["codcategoria"]) && $_POST["codcategoria"] != NULL && $_POST["codcategoria"] != "") {
    $and .= " and produto.codcategoria = '{$_POST["codcategoria"]}'";
}
if (isset($_POST["coddepartamento"]) && $_POST["coddepartamento"] != NULL && $_POST["coddepartamento"] != "") {
    $and .= " and departamento.coddepartamento = '{$_POST["coddepartamento"]}'";
}
if (isset($_POST["coddiretoria"]) && $_POST["coddiretoria"] != NULL && $_POST["coddiretoria"] != "") {
    $and .= " and diretoria.coddiretoria = '{$_POST["coddiretoria"]}'";
}
if (isset($_POST["codstatus"]) && $_POST["codstatus"] != NULL && $_POST["codstatus"] != "") {
    $and .= " and produto.codstatus = '{$_POST["codstatus"]}'";
}
if (isset($_POST["procurar_menu"]) && $_POST["procurar_menu"] != NULL && $_POST["procurar_menu"] != "") {
    $and .= " and (status.nome    like '%{$_POST["procurar_menu"]}%' 
             or diretoria.nome    like '%{$_POST["procurar_menu"]}%' 
             or categoria.nome    like '%{$_POST["procurar_menu"]}%'    
             or produto.nome      like '%{$_POST["procurar_menu"]}%'    
             or departamento.nome like '%{$_POST["procurar_menu"]}%')";
}

$sql = 'select produto.codproduto, produto.nome, produto.codcategoria, status.nome as status,
    DATE_FORMAT(produto.dtcadastro, "%d/%m/%Y") as dtcadastro2, categoria.nome as categoria,
    status.cor, departamento.nome as departamento,
    (select valor from valorproduto where codatributo = 5 and codproduto = produto.codproduto) as utilizador,
    (select valor from valorproduto where codatributo = 1 and codproduto = produto.codproduto) as nome,
    (select valor from valorproduto where codatributo = 15 and codproduto = produto.codproduto) as dtcompra,
    (select valor from valorproduto where codatributo = 3 and codproduto = produto.codproduto) as serialtag,
    (select valor from valorproduto where codatributo = 17 and codproduto = produto.codproduto) as statusgarantia,
    (select valor from valorproduto where codatributo = 2 and codproduto = produto.codproduto) as patrimonio
    from produto 
    inner join categoriaproduto as categoria on categoria.codcategoria = produto.codcategoria 
    inner join departamento on departamento.coddepartamento = produto.coddepartamento
    inner join diretoria on diretoria.coddiretoria = departamento.coddiretoria
    inner join statusproduto as status on status.codstatus = produto.codstatus
    where 1 = 1 ' . $and . ' order by produto.nome';
$res = $conexao->comando($sql)or die('Erro no comando: <pre>' . $sql . '</pre>');
$qtd = $conexao->qtdResultado($res);
if ($qtd > 0) {
    $nome = 'Rel. Produto';
    $html .= '<table class="responstable">';
    $html .= '<thead>';
    $html .= '<tr>';
    $html .= '<th>Nome</th>';
    $html .= '<th>Categoria</th>';
    $html .= '<th style="width: 200px;">Departamento</th>';
    $html .= '<th style="width: 200px;">Usuário</th>';
    $html .= '<th>Serial / TAG</th>';
    $html .= '<th>Dt. Compra</th>';
    
    if (isset($_POST["tipo"]) && $_POST["tipo"] == "xls") {
        $html .= '<th style="width: 50px;">Uso</th>';
        $html .= '<th>Status Uso</th>';
    }
    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';
    while ($produto = $conexao->resultadoArray($res)) {
        $tempoUso = strtotime(date("Y-m-d")) - strtotime($produto["dtcompra"]);
        $dias = (int) floor($tempoUso / (60 * 60 * 24)); // 225 dias
        if ($dias > 30 && $dias < 365) {
            $dias = $dias / 30;
        } elseif ($dias > 365) {
            $dias = $dias / 30 / 12;
        } elseif ($dias < 30) {
            $dias = 0;
        }

        if (isset($produto["statusgarantia"]) && $produto["statusgarantia"] != NULL) {
            if (strtotime($produto["statusgarantia"]) > strtotime(date("Y-m-d"))) {
                $corVGarantia = 'color: green';
                $statusGarantia = 'V';
            } else {
                $corVGarantia = 'color: red';
                $statusGarantia = 'X';
            }
        }
        $html .= '<tr style="background: '.$produto["cor"] .' !important">';
        $html .= '<td style="text-align: left;">' . $produto["nome"] . '</td>';
        $html .= '<td style="text-align: left;">' . $produto["categoria"] . '</td>';
        $html .= '<td style="text-align: left;">' . $produto["departamento"] . '</td>';
        $html .= '<td style="text-align: left;">' . $produto["utilizador"] . '</td>';
        $html .= '<td style="text-align: left;">' . $produto["serialtag"] . '</td>';
        $html .= '<td style="text-align: left;">' . date("d/m/Y", strtotime($produto["dtcompra"])) . '</td>';
        
        if (isset($_POST["tipo"]) && $_POST["tipo"] == "xls") {
            $html .= '<td style="text-align: left;">' . number_format($dias, 1, ',', '')  . '</td>';
            $html .= '<td style="text-align: left;'.$corVGarantia.'">' . $statusGarantia . '</td>';
        }
        $html .= '</tr>';
    }
    $html .= '</tbody>';
    $html .= '</table>';

    $_POST["html"] = $html;
    $paisagem = "sim";
    if (isset($_POST["tipo"]) && $_POST["tipo"] == "xls") {
        include "./GeraExcel.php";
    } else {
        include "./GeraPdf.php";
    }
} else {
    echo '<script>alert("Sem produto encontrado!");window.close();</script>';
}

