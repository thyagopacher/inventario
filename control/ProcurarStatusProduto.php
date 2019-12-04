<?php
session_start();
include "../model/Conexao.php";
$conexao = new Conexao();

if(!isset($_POST["codpagina"]) || $_POST["codpagina"] == NULL || $_POST["codpagina"] == ""){
    $_POST["codpagina"] = $_SESSION["codpagina"];
}
$sql = "select np.excluir, np.atualizar
from nivelpagina as np
where np.codnivel  = {$_SESSION["codnivel"]} 
and   np.codpagina = 100";
$nivelp = $conexao->comandoArray($sql);

if (isset($_POST["nome"]) && $_POST["nome"] != NULL && $_POST["nome"] != "") {
    $and .= " and status.nome like '%{$_POST["nome"]}%'";
}
$res = $conexao->comando('select status.codstatus, status.nome as status, DATE_FORMAT(status.dtcadastro, "%d/%m/%Y") as dtcadastro2, status.cor
    from statusproduto as status 
    where 1 = 1 ' . $and . ' order by status.nome');
$qtd = $conexao->qtdResultado($res);

if ($qtd > 0) {
    ?>
    <table id="table_status">
        <thead>
            <tr>
                <th>
                    Dt. Cadastro
                </th>
                <th>
                    Nome
                </th> 
                <th>
                    Cor
                </th> 
                <th>
                    Opções
                </th>
            </tr>
        </thead>
        <tbody>
            <?php while ($status = $conexao->resultadoArray($res)) { ?>
                <tr>
                    <td><?= $status["dtcadastro2"] ?></td>
                    <td><?= $status["status"] ?></td>
                    <td style="background: <?= $status["cor"] ?>"><?= $status["cor"] ?></td>
                    <td>
                        <?php
                        if($nivelp["atualizar"] == 1){
                            $arrayJavascript = "new Array('{$status["codstatus"]}', '{$status["status"]}', '{$status["cor"]}')";
                            echo '<a href="javascript: setaEditarStatusProduto(', $arrayJavascript, ')" title="Clique aqui para editar"><img class="imgIcone" src="./recursos/img/editar.png" alt="botão editar"/></a>';
                        }
                        if($nivelp["excluir"] == 1){
                            echo '<a href="javascript: excluirStatusProduto(', $status["codstatus"], ')" title="Clique aqui para excluir"><img class="imgIcone" src="./recursos/img/excluir.png" alt="botão excluir"/></a>';
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