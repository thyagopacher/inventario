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

$res = $conexao->comando('select * from modulo where 1 = 1 order by nome');
$qtd = $conexao->qtdResultado($res);

if ($qtd > 0) {
    ?>
    <table id="table_modulo">
        <thead>
            <tr>
                <th>
                    Nome
                </th>
                <th>
                    Titulo
                </th>
                <th>
                    Opções
                </th>
            </tr>
        </thead>
        <tbody>
            <?php while ($modulo = $conexao->resultadoArray($res)) { ?>
                <tr>
                    <td>
                        <?= $modulo["nome"] ?>
                    </td>
                    <td>
                        <?= $modulo["titulo"] ?>
                    </td>
                    <td>
                        <?php
                        if($nivelp["atualizar"] == 1){
                            $arrayJavascript = "new Array('{$modulo["codmodulo"]}', '{$modulo["nome"]}', '{$modulo["titulo"]}', '{$modulo["icone"]}')";
                            echo '<a href="javascript:setaEditarModulo(', $arrayJavascript, ')" title="Clique aqui para editar"><img class="imgIcone" src="./recursos/img/editar.png" alt="botão editar"/></a>';
                        }
                        if($nivelp["excluir"] == 1){
                            echo '<a href="#" onclick="excluirModulo(', $modulo["codmodulo"], ')" title="Clique aqui para excluir"><img class="imgIcone" src="./recursos/img/excluir.png" alt="botão excluir"/></a>';
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