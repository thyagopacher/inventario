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
    $and .= " and pagina.nome like '%{$_POST["nome"]}%'";
}
$res = $conexao->comando('select * from pagina where 1 = 1 ' . $and . ' order by nome');
$qtd = $conexao->qtdResultado($res);

if ($qtd > 0) {
    ?>
    <table id="table_pagina">
        <thead>
            <tr>
                <th>
                    <input type="checkbox" name="marcarTudo" id="marcarTudo" onclick="marcarTudoPagina();" value="s"/>
                </th>
                <th>
                    Nome
                </th>
                <th>
                    Link
                </th>
                <th>
                    Icone
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
            <?php while ($pagina = $conexao->resultadoArray($res)) { ?>
                <tr>
                    <td>
                        <input class="checkbox_pagina" type="checkbox" name="paginas_selecao[]" value="<?= $pagina["codpagina"] ?>"/>
                    </td>
                    <td>
                        <?= $pagina["nome"] ?>
                    </td>
                    <td><?= $pagina["link"] ?></td>
                    <td><?= $pagina["icone"] ?></td>
                    <td><?= $pagina["titulo"] ?></td>
                    <td>
                        <?php
                        if($nivelp["atualizar"] == 1){
                            $arrayJavascript = "new Array('{$pagina["codpagina"]}', '{$pagina["nome"]}', '{$pagina["titulo"]}', '{$pagina["link"]}', '{$pagina["codmodulo"]}', '{$pagina["abreaolado"]}', '{$pagina["icone"]}', '{$pagina["codpai"]}')";
                            echo '<a href="javascript:setaEditarPagina(', $arrayJavascript, ')" title="Clique aqui para editar"><img class="imgIcone" src="./recursos/img/editar.png" alt="botão editar"/></a>';
                        }
                        if($nivelp["excluir"] == 1){
                            echo '<a href="#" onclick="excluirPagina(', $pagina["codpagina"], ')" title="Clique aqui para excluir"><img class="imgIcone" src="./recursos/img/excluir.png" alt="botão excluir"/></a>';
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