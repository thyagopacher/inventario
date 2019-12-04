<?php
include "../model/Conexao.php";
$conexao = new Conexao();

if (isset($_POST["nome"]) && $_POST["nome"] != NULL && $_POST["nome"] != "") {
    $and .= " and programa.nome like '%{$_POST["nome"]}%'";
}
$res = $conexao->comando('select programa.codprograma, programa.nome as programa, DATE_FORMAT(programa.dtcadastro, "%d/%m/%Y") as dtcadastro2, pessoa.nome as funcionario
    from programa 
    inner join pessoa on pessoa.codpessoa = programa.codfuncionario
    where 1 = 1 ' . $and . ' order by programa.nome');
$qtd = $conexao->qtdResultado($res);

if ($qtd > 0) {
    ?>
    <table id="table_programa">
        <thead>
            <tr>
                <th>
                    Nome
                </th>
                <th>
                    Dt. Cadastro
                </th>
                <th>
                    Opções
                </th>
            </tr>
        </thead>
        <tbody>
            <?php while ($programa = $conexao->resultadoArray($res)) { ?>
                <tr>
                    <td><?= $programa["programa"] ?></td>
                    <td><?= $programa["dtcadastro2"] ?></td>
                    <td><?= $programa["funcionario"] ?></td>
                    <td>
                        <?php
                        $arrayJavascript = "new Array('{$programa["codprograma"]}', '{$programa["nome"]}')";
                        echo '<a href="javascript: setaEditarPrograma(', $arrayJavascript, ')" title="Clique aqui para editar"><img class="imgIcone" src="./recursos/img/editar.png" alt="botão editar"/></a>';
                        echo '<a href="javascript: excluirPrograma(', $programa["codprograma"], ')" title="Clique aqui para excluir"><img class="imgIcone" src="./recursos/img/excluir.png" alt="botão excluir"/></a>';
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