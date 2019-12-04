<?php
include "../model/Conexao.php";
$conexao = new Conexao();

if (isset($_POST["coddepartamento"]) && $_POST["coddepartamento"] != NULL && $_POST["coddepartamento"] != "") {
    $and .= " and produto.coddepartamento = ".$_POST["coddepartamento"];
}
if (isset($_POST["codproduto"]) && $_POST["codproduto"] != NULL && $_POST["codproduto"] != "") {
    $and .= " and log.codproduto = {$_POST["codproduto"]}";
}
//dt de compra
if (isset($_POST["dataCompra1"]) && $_POST["dataCompra1"] != NULL && $_POST["dataCompra1"] != "") {
    if (strpos($_POST["dataCompra1"], "/")) {
        $data1 = implode("-", array_reverse(explode("/", $_POST["dataCompra1"])));
    } else {
        $data1 = $_POST["dataCompra1"];
    }
    $and .= " and produto.codproduto in(select codproduto from valorproduto where codatributo = 15 and valor >= '{$data1}')";
}
if (isset($_POST["dataCompra2"]) && $_POST["dataCompra2"] != NULL && $_POST["dataCompra2"] != "") {
    if (strpos($_POST["dataCompra2"], "/")) {
        $data1 = implode("-", array_reverse(explode("/", $_POST["dataCompra2"])));
    } else {
        $data1 = $_POST["dataCompra2"];
    }
    $and .= " and produto.codproduto in(select codproduto from valorproduto where codatributo = 15 and valor <= '{$data1}')";
}
if (isset($_POST["codstatus"]) && $_POST["codstatus"] != NULL && $_POST["codstatus"] != "") {
    $and .= " and produto.codstatus = '{$_POST["codstatus"]}'";
}
if (isset($_POST["observacao"]) && $_POST["observacao"] != NULL && $_POST["observacao"] != "") {
    $and .= " and log.observacao like '%".$conexao->trataString($_POST["observacao"])."%'";
}
if (isset($_POST["data1"]) && $_POST["data1"] != NULL && $_POST["data1"] != "") {
    if (strpos($_POST["data1"], "/")) {
        $data1 = implode("-", array_reverse(explode("/", $_POST["data1"])));
    } else {
        $data1 = $_POST["data1"];
    }
    $and .= " and log.dtcadastro >= '{$data1}'";
}
if (isset($_POST["data2"]) && $_POST["data2"] != NULL && $_POST["data2"] != "") {
    if (strpos($_POST["data2"], "/")) {
        $data1 = implode("-", array_reverse(explode("/", $_POST["data2"])));
    } else {
        $data1 = $_POST["data2"];
    }
    $and .= " and log.dtcadastro <= '{$data1}'";
}

$sql = 'select log.codlog, log.observacao, pessoa.nome as funcionario, 
    DATE_FORMAT(log.dtcadastro, "%d/%m/%Y") as dtcadastro2, log.dtcadastro
    from log 
    inner join pessoa  on pessoa.codpessoa   = log.codfuncionario
    left  join produto on produto.codproduto = log.codproduto
    where 1 = 1 ' . $and . ' order by log.dtcadastro';
$res = $conexao->comando($sql);
$qtd = $conexao->qtdResultado($res);

if ($qtd > 0) {
    ?> 
    <table id="table_log">
        <thead>
            <tr>
                <th>Dt. Cadastro</th>
                <th>Observação</th>
                <th>Funcionário</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($log = $conexao->resultadoArray($res)) { ?>
                <tr>
                    <td data-order="<?= $log["dtcadastro"] ?>"><?= $log["dtcadastro2"] ?></td>
                    <td><?= str_replace('\n', '<br>', str_replace('\r\n', '<br>', $log["observacao"])) ?></td>
                    <td><?= $log["funcionario"] ?></td>
                    
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php
}
?>