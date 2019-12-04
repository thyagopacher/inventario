<?php
session_start();
//validação caso a sessão caia
if (!isset($_SESSION)) {
    die("<script>alert('Sua sessão caiu, por favor logue novamente!!!');window.close();</script>");
}
include "../model/Conexao.php";
$conexao = new Conexao();
$and = "";

if(!isset($_POST["codpagina"]) || $_POST["codpagina"] == NULL || $_POST["codpagina"] == ""){
    $_POST["codpagina"] = $_SESSION["codpagina"];
}
$sql = "select np.excluir, np.atualizar
from nivelpagina as np
where np.codnivel  = {$_SESSION["codnivel"]} 
and   np.codpagina = 99";
$nivelp = $conexao->comandoArray($sql);

if (isset($_POST["nome"]) && $_POST["nome"] != NULL && $_POST["nome"] != "") {
    $and .= " and categoria.nome like '%{$_POST["nome"]}%'";
}
if (isset($_POST["data1"]) && $_POST["data1"] != NULL && $_POST["data1"] != "") {
    if (strpos($_POST["data1"], "/")) {
        $data1 = implode("-", array_reverse(explode("/", $_POST["data1"])));
    } else {
        $data1 = $_POST["data1"];
    }
    $and .= " and categoria.dtcadastro >= '{$data1}'";
}
if (isset($_POST["data2"]) && $_POST["data2"] != NULL && $_POST["data2"] != "") {
    if (strpos($_POST["data2"], "/")) {
        $data1 = implode("-", array_reverse(explode("/", $_POST["data2"])));
    } else {
        $data1 = $_POST["data2"];
    }
    $and .= " and categoria.dtcadastro <= '{$_POST["data2"]}'";
}


$sql = 'select categoria.codcategoria, categoria.nome, DATE_FORMAT(categoria.dtcadastro, "%d/%m/%Y") as dtcadastro2
    from categoriaproduto as categoria 
    where 1 = 1 ' . $and . ' order by nome';
$res = $conexao->comando($sql)or die('Erro no comando: <pre>' . $sql . '</pre>');
$qtd = $conexao->qtdResultado($res);
if ($qtd > 0) {
    ?>
    <table id="table_categoria_produto">
        <thead>
            <tr>
                <th>
                    Data Cad.
                </th>
                <th>
                    Nome
                </th>
                <th>
                    Opções
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($categoria = $conexao->resultadoArray($res)) {
                ?>
                <tr>
                    <td>
                        <?= $categoria["dtcadastro2"] ?>
                    </td>
                    <td>
                        <?= $categoria["nome"] ?>
                    </td>
                    <td>
                        <?php
                        if ($nivelp["atualizar"] == 1) {
                            $arrayJavascript = "new Array('{$categoria["codcategoria"]}', '{$categoria["nome"]}')";
                            echo '<a href="javascript:setaEditarCategoriaProduto(', $arrayJavascript, ')" title="Clique aqui para editar"><img class="imgIcone" src="./recursos/img/editar.png" alt="botão editar"/></a>';
                        }
                        if ($nivelp["excluir"] == 1) {
                            echo '<a href="#" onclick="excluirCategoriaProduto(', $categoria["codcategoria"], ')" title="Clique aqui para excluir"><img class="imgIcone" src="./recursos/img/excluir.png" alt="botão excluir"/></a>';
                        }
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>

    </table>
    <?php
}
?>