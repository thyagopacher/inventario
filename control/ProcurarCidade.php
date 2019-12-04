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
    $and .= " and cidade.nome like '%" . $conexao->trataString($_POST["nome"]) . "%'";
}
$res = $conexao->comando('select cidade.nome as cidade, estado.nome as estado, cidade.codestado, cidade.codcidade
    from cidade 
    inner join estado on estado.codestado = cidade.codestado
    where 1 = 1 ' . $and . ' order by cidade.nome');
$qtd = $conexao->qtdResultado($res);

if ($qtd > 0) {
    ?>
    <table id="table_cidade">
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
            <?php while ($cidade = $conexao->resultadoArray($res)) { ?>
                <tr>
                    <td>
                        <?= $cidade["cidade"] ?>
                    </td>
                    <td>
                        <?= $cidade["estado"] ?>
                    </td>
                    <td>
                        <?php
                        if ($nivelp["atualizar"] == 1) {
                            $arrayJavascript = "new Array('{$cidade["codcidade"]}', '{$cidade["cidade"]}', '{$cidade["codestado"]}')";
                            echo '<a href="javascript:setaEditarCidade(', $arrayJavascript, ')" title="Clique aqui para editar"><img class="imgIcone" src="./recursos/img/editar.png" alt="botão editar"/></a>';
                        }
                        if ($nivelp["excluir"] == 1) {
                            echo '<a href="#" onclick="excluirCidade(', $cidade["codcidade"], ')" title="Clique aqui para excluir"><img class="imgIcone" src="./recursos/img/excluir.png" alt="botão excluir"/></a>';
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