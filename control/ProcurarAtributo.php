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
    $and .= " and atributo.nome like '%{$_POST["nome"]}%'";
}
$res = $conexao->comando('select atributo.codatributo, atributo.nome, atributo.tipo, atributo.tamanho,
        atributo.lista, atributo.mascara, atributo.ordem
    from atributo 
    where 1 = 1 ' . $and . ' order by atributo.nome');
$qtd = $conexao->qtdResultado($res);

if ($qtd > 0) {
    ?>
    <table id="table_atributo">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Tamanho</th>
                <th>Ordem</th>
                <th>Opções</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($atributo = $conexao->resultadoArray($res)) { ?>
                <tr>
                    <td><?= $atributo["nome"] ?></td>
                    <td><?= $atributo["tipo"] ?></td>
                    <td><?= $atributo["tamanho"] ?></td>
                    <td><?= $atributo["ordem"] ?></td>
                    <td>
                        <?php
                        if($nivelp["atualizar"] == 1){
                            $arrayJavascript = "new Array('{$atributo["codatributo"]}', '{$atributo["nome"]}', '{$atributo["tipo"]}', '{$atributo["tamanho"]}', '{$atributo["lista"]}', '{$atributo["mascara"]}', '{$atributo["ordem"]}')";
                            echo '<a href="javascript: setaEditarAtributo(', $arrayJavascript, ')" title="Clique aqui para editar">';
                            echo '<img class="imgIcone" src="./recursos/img/editar.png" alt="botão editar"/></a>';
                        }
                        if($nivelp["excluir"] == 1){
                            echo '<a href="javascript: excluirAtributo(', $atributo["codatributo"], ')" title="Clique aqui para excluir"><img class="imgIcone" src="./recursos/img/excluir.png" alt="botão excluir"/></a>';
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