<?php
session_start();
include "../model/Conexao.php";
$conexao = new Conexao();

if(!isset($_POST["codpagina"]) || $_POST["codpagina"] == NULL || $_POST["codpagina"] == ""){
    $_POST["codpagina"] = $_SESSION["codpagina"];
}
$sql = "select np.excluir, np.atualizar
from nivelpagina as np
where np.codnivel = '{$_SESSION["codnivel"]}' and np.codpagina = '{$_POST["codpagina"]}'";
$nivelp = $conexao->comandoArray($sql);

if (isset($_POST["nome"]) && $_POST["nome"] != NULL && $_POST["nome"] != "") {
    $and .= " and departamento.nome like '%{$_POST["nome"]}%'";
}
$res = $conexao->comando('select departamento.nome as departamento, diretoria.nome as diretoria, departamento.coddiretoria, departamento.coddepartamento
    from departamento 
    inner join diretoria on diretoria.coddiretoria = departamento.coddiretoria
    where 1 = 1 ' . $and . ' order by departamento.nome');
$qtd = $conexao->qtdResultado($res);

if ($qtd > 0) {
    ?> 
    <table id="table_departamento">
        <thead>
            <tr>
                <th>
                    Nome
                </th>
                <th>
                    Diretoria
                </th>
                <th>
                    Opções
                </th>
            </tr>
        </thead>
        <tbody>
            <?php while ($departamento = $conexao->resultadoArray($res)) { ?>
                <tr>
                    <td>
                        <?= $departamento["departamento"] ?>
                    </td>
                    <td>
                        <?= $departamento["diretoria"] ?>
                    </td>
                    <td>
                        <?php
                        if ($nivelp["atualizar"] == 1) {
                            $arrayJavascript = "new Array('{$departamento["coddepartamento"]}', '{$departamento["departamento"]}', '{$departamento["coddiretoria"]}')";
                            echo '<a href="javascript:setaEditarDepartamento(', $arrayJavascript, ')" title="Clique aqui para editar"><img class="imgIcone" src="./recursos/img/editar.png" alt="botão editar"/></a>';
                        }
                        if ($nivelp["excluir"] == 1) {
                            echo '<a href="#" onclick="excluirDepartamento(', $departamento["coddepartamento"], ')" title="Clique aqui para excluir"><img class="imgIcone" src="./recursos/img/excluir.png" alt="botão excluir"/></a>';
                        }
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>

    </table>
    <?php
    $classe_linha = "even";
}
?>