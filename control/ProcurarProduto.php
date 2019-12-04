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

if(!isset($_POST["codpagina"]) || $_POST["codpagina"] == NULL || $_POST["codpagina"] == ""){
    $_POST["codpagina"] = $_SESSION["codpagina"];
}
$sql = "select np.excluir, np.atualizar
from nivelpagina as np
where np.codnivel = '{$_SESSION["codnivel"]}' and np.codpagina = '{$_POST["codpagina"]}'";          
$nivelp = $conexao->comandoArray($sql);

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
    $and .= " and produto.codproduto in(select codproduto from valorproduto where codatributo = {$_POST["codatributo"]} and valor <> '')";
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
    $and .= " and (status.nome    like '%".$conexao->trataString($_POST["procurar_menu"])."%' 
             or diretoria.nome    like '%".$conexao->trataString($_POST["procurar_menu"])."%' 
             or categoria.nome    like '%".$conexao->trataString($_POST["procurar_menu"])."%' 
             or produto.nome      like '%".$conexao->trataString($_POST["procurar_menu"])."%' 
             or departamento.nome like '%".$conexao->trataString($_POST["procurar_menu"])."%')";
}

$sql = 'select produto.codproduto, produto.nome, produto.codcategoria, status.nome as status,
    DATE_FORMAT(produto.dtcadastro, "%d/%m/%Y") as dtcadastro2, categoria.nome as categoria,
    status.cor, departamento.nome as departamento,
    (select valor from valorproduto where codatributo = 5 and codproduto = produto.codproduto) as utilizador,
    (select valor from valorproduto where codatributo = 1 and codproduto = produto.codproduto) as nome,
    (select valor from valorproduto where codatributo = 15 and codproduto = produto.codproduto) as dtcompra,
    (select valor from valorproduto where codatributo = 3 and codproduto = produto.codproduto) as serialtag,
    (select valor from valorproduto where codatributo = 17 and codproduto = produto.codproduto) as statusgarantia,
    (select valor from valorproduto where codatributo = 2 and codproduto = produto.codproduto) as patrimonio,
    (select valor from valorproduto where codatributo = 6 and codproduto = produto.codproduto) as fabricante
    from produto 
    inner join categoriaproduto as categoria on categoria.codcategoria = produto.codcategoria 
    inner join departamento on departamento.coddepartamento = produto.coddepartamento
    inner join diretoria on diretoria.coddiretoria = departamento.coddiretoria
    inner join statusproduto as status on status.codstatus = produto.codstatus
    where 1 = 1 ' . $and . ' order by produto.nome';
$res = $conexao->comando($sql)or die('Erro no comando: <pre>' . $sql . '</pre>');
$qtd = $conexao->qtdResultado($res);
if ($qtd > 0) {
    ?>
    <table id="table_produto" style="font-size: 12px;">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Fabricante</th>
                <th>Utilizador</th>
                <th>Departamento</th>
                <th>Patrimônio</th>
                <th>Serial / TAG</th>
                <th>Dt. Compra</th>
                <th>Uso</th>
                <th>Opções</th>
            </tr>
        </thead>
        <tbody>
            <?php
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
                ?>
                <tr style="background: <?= $produto["cor"] ?> !important">
                    <td><?= $produto["nome"] ?></td>
                    <td><?= $produto["categoria"] ?></td>
                    <td><?= $produto["fabricante"] ?></td>
                    <td><?= $produto["utilizador"] ?></td>
                    <td><?= $produto["departamento"] ?></td>
                    <td><?= $produto["patrimonio"] ?></td>
                    <td><?= $produto["serialtag"] ?></td>
                    <td>
                        <?php
                    if(isset($produto["dtcompra"]) && $produto["dtcompra"] != NULL && $produto["dtcompra"] != ""){
                        echo date("d/m/Y", strtotime($produto["dtcompra"]));
                    }
                            ?>
                    </td>
                    <td><?= number_format($dias, 1, ',', '') ?></td>
                    <td>
                        <?php
                        if($nivelp["atualizar"] == 1){
                            echo '<a href="Produto.php?codproduto=', $produto["codproduto"], '" title="Clique aqui para editar">';
                            echo '<img class="imgIcone" src="./recursos/img/editar.png" alt="botão editar"/>';
                            echo '</a>';
                        }
                        if($nivelp["excluir"] == 1){
                            echo '<a href="javascript: excluirProduto(', $produto["codproduto"], ')" title="Clique aqui para excluir">';
                            echo '<img class="imgIcone" src="./recursos/img/excluir.png" alt="botão excluir"/>';
                            echo '</a>';
                        }
                        echo '<a href="Log.php?codproduto=', $produto["codproduto"], '" title="Clique aqui para abir ultimo log"><img style="width: 20px;" src="./recursos/img/livro.png" alt="botão livro"/></a>';
                        ?>
                    </td>
                </tr>
                <?php
               
            }
            ?>
        </tbody>

    </table>
    <?php
}
?>