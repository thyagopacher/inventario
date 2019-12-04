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
where np.codnivel = '{$_SESSION["codnivel"]}' and np.codpagina = '{$_POST["codpagina"]}'";
$nivelp = $conexao->comandoArray($sql);

if (isset($_POST["codcategoria"]) && $_POST["codcategoria"] != NULL && $_POST["codcategoria"] != "") {
    $and .= " and cp.codcategoria = {$_POST["codcategoria"]}";
}
if (isset($_POST["codatributo"]) && $_POST["codatributo"] != NULL && $_POST["codatributo"] != "") {
    $and .= " and ac.codatributo = {$_POST["codatributo"]}";
}
if (isset($_POST["nome"]) && $_POST["nome"] != NULL && $_POST["nome"] != "") {
    $and .= " and cp.nome like '%{$_POST["nome"]}%'";
}
if (isset($_POST["data1"]) && $_POST["data1"] != NULL && $_POST["data1"] != "") {
    if (strpos($_POST["data1"], "/")) {
        $data1 = implode("-", array_reverse(explode("/", $_POST["data1"])));
    } else {
        $data1 = $_POST["data1"];
    }
    $and .= " and ac.dtcadastro >= '{$data1}'";
}
if (isset($_POST["data2"]) && $_POST["data2"] != NULL && $_POST["data2"] != "") {
    if (strpos($_POST["data2"], "/")) {
        $data1 = implode("-", array_reverse(explode("/", $_POST["data2"])));
    } else {
        $data1 = $_POST["data2"];
    }
    $and .= " and ac.dtcadastro <= '{$_POST["data2"]}'";
}


$sql = 'select atributo.nome as atributo, cp.nome as categoria, 
    DATE_FORMAT(cp.dtcadastro, "%d/%m/%Y") as dtcadastro2, ac.codac, 
    ac.codatributo, ac.codcategoria, ac.obrigatorio
    from atributocategoria as ac 
    inner join atributo on atributo.codatributo = ac.codatributo
    inner join categoriaproduto as cp on cp.codcategoria = ac.codcategoria
    where 1 = 1 ' . $and. ' order by atributo.nome';

$res = $conexao->comando($sql)or die('Erro no comando: <pre>'.$sql.'</pre>');
$qtd = $conexao->qtdResultado($res);
if ($qtd > 0) {
    ?>
                    <table id="table_atributo_categoria">
                        <thead>
                            <tr>
                                <th>
                                    Data Cad.
                                </th>
                                <th>
                                    Atributo
                                </th>
                                <th>
                                    Categoria
                                </th>
                                <th>
                                    Obrigatório
                                </th>
                                <th>
                                    Opções
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            while ($ac = $conexao->resultadoArray($res)) { 
                                ?>
                                <tr>
                                    <td><?= $ac["dtcadastro2"] ?></td>
                                    <td><?= $ac["atributo"] ?></td>
                                    <td><?= $ac["categoria"] ?></td>
                                    <td><?= $ac["obrigatorio"] ?></td>
                                    <td>
                                        <?php
                                        if($nivelp["atualizar"] == 1){
                                            $arrayJavascript = "new Array('{$ac["codac"]}', '{$ac["codatributo"]}', '{$ac["codcategoria"]}', '{$ac["obrigatorio"]}')";
                                            echo '<a href="javascript: setaEditarAtributoCategoria(',$arrayJavascript,')" title="Clique aqui para editar"><img class="imgIcone" src="./recursos/img/editar.png" alt="botão editar"/></a>';
                                        }
                                        if($nivelp["excluir"] == 1){
                                            echo '<a href="javascript: excluirAtributoCategoria(', $ac["codac"], ')" title="Clique aqui para excluir"><img class="imgIcone" src="./recursos/img/excluir.png" alt="botão excluir"/></a>';
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