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
    $and .= " and local.nome like '%{$_POST["nome"]}%'";
}
$sql = 'select local.nome as local, cidade.nome as cidade, lc.codlc, lc.codcidade, lc.codlocal
    from localcidade as lc
    inner join cidade on cidade.codcidade = lc.codcidade
    inner join local  on local.codlocal   = lc.codlocal
    where 1 = 1 ' . $and . ' order by local.nome';

$res = $conexao->comando($sql);
$qtd = $conexao->qtdResultado($res);

if ($qtd > 0) {
    ?>
    <table id="table_local_cidade">
        <thead>
            <tr>
                <th>Local</th>
                <th>Cidade</th>
                <th>Opções</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($local = $conexao->resultadoArray($res)) { ?>
                <tr>
                    <td><?= $local["local"] ?></td>
                    <td><?= $local["cidade"] ?></td>
                    <td>
                        <?php
                        if($nivelp["atualizar"] == 1){
                            $arrayJavascript = "new Array('{$local["codlc"]}', '{$local["codlocal"]}', '{$local["codcidade"]}')";
                            echo '<a href="javascript: setaEditarLocalCidade(', $arrayJavascript, ')" title="Clique aqui para editar"><img class="imgIcone" src="./recursos/img/editar.png" alt="botão editar"/></a>';
                        }
                        if($nivelp["excluir"] == 1){
                            echo '<a href="javascript: excluirLocalCidade(', $local["codlc"], ')" title="Clique aqui para excluir"><img class="imgIcone" src="./recursos/img/excluir.png" alt="botão excluir"/></a>';
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