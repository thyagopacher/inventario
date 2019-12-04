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
    $and .= " and estado.nome like '%{$_POST["nome"]}%'";
}
$res = $conexao->comando('select estado.codestado, estado.nome as estado, estado.sigla
    from estado 
    where 1 = 1 ' . $and . ' order by estado.nome');
$qtd = $conexao->qtdResultado($res);

if ($qtd > 0) {
    ?>
    <table id="table_estado">
        <thead>
            <tr>
                <th>
                    Nome
                </th>
                <th>
                    Sigla
                </th>
                <th>
                    Opções
                </th>
            </tr>
        </thead>
        <tbody>
            <?php while ($estado = $conexao->resultadoArray($res)) { ?>
                <tr>
                    <td>
                        <?= $estado["estado"] ?>
                    </td>
                    <td>
                        <?= $estado["sigla"] ?>
                    </td>
                    <td>
                        <?php
                        if ($nivelp["atualizar"] == 1) {
                            $arrayJavascript = "new Array('{$estado["codestado"]}', '{$estado["estado"]}', '{$estado["sigla"]}')";
                            echo '<a href="javascript: setaEditarEstado(', $arrayJavascript, ')" title="Clique aqui para editar"><img class="imgIcone" src="./recursos/img/editar.png" alt="botão editar"/></a>';
                        }
                        if ($nivelp["excluir"] == 1) {
                            echo '<a href="javascript: excluirEstado(', $estado["codestado"], ')" title="Clique aqui para excluir"><img class="imgIcone" src="./recursos/img/excluir.png" alt="botão excluir"/></a>';
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