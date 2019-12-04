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
    $and .= " and diretoria.nome like '%{$_POST["nome"]}%'";
}
$res = $conexao->comando('select diretoria.coddiretoria, diretoria.nome as diretoria
    from diretoria 
    where 1 = 1 ' . $and . ' order by diretoria.nome');
$qtd = $conexao->qtdResultado($res);

if ($qtd > 0) {
    ?>
    <table id="table_diretoria">
        <thead>
            <tr>
                <th>
                    Nome
                </th>
                <th>
                    Opções
                </th>
            </tr>
        </thead>
        <tbody>
            <?php while ($diretoria = $conexao->resultadoArray($res)) { ?>
                <tr>
                    <td>
                        <?= $diretoria["diretoria"] ?>
                    </td>
                    <td>
                        <?php
                        if ($nivelp["atualizar"] == 1) {
                            $arrayJavascript = "new Array('{$diretoria["coddiretoria"]}', '{$diretoria["diretoria"]}')";
                            echo '<a href="javascript: setaEditarDiretoria(', $arrayJavascript, ')" title="Clique aqui para editar"><img class="imgIcone" src="./recursos/img/editar.png" alt="botão editar"/></a>';
                        }
                        if ($nivelp["excluir"] == 1) {
                            echo '<a href="javascript: excluirDiretoria(', $diretoria["coddiretoria"], ')" title="Clique aqui para excluir"><img class="imgIcone" src="./recursos/img/excluir.png" alt="botão excluir"/></a>';
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