<?php
include "validacaoLogin.php";
if (isset($_GET["codpessoa"]) && $_GET["codpessoa"] != NULL && trim($_GET["codpessoa"]) != "") {
    $sql = "select *
        from pessoa where codpessoa = ". (int)$_GET["codpessoa"];
    $pessoap = $conexao->comandoArray($sql);
}
$action = "../control/SalvarPessoa.php";
?>  
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title><?=  ($empresap["razao"])?> | Painel ADM.</title>
        <?php include 'head.php';?>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">

        <div class="wrapper">

            <?php include "header.php"; ?>
            <?php include "menu.php"; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?= $titulo ?>

                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#"><?= $nivelp["modulo"] ?></a></li>
                        <li class="active"><?= $nivelp["pagina"] ?></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div id="tabs">
                        <ul>
                            <li><a href="#tabs-1">Cadastro</a></li>
                            <?php if ($nivelp["procurar"] == 1 || $_SESSION["codnivel"] == '1') { ?>
                                <li><a href="#tabs-2">Procurar</a></li>
                            <?php } ?>

                        </ul>   
                        <div id="tabs-1">
                            <?php include("formPessoa.php"); ?>
                        </div> 
                        <?php if ($nivelp["procurar"] == 1 || $_SESSION["codnivel"] == '1') { ?>
                            <div id="tabs-2">
                                <?php include("formProcurarPessoa.php"); ?>
                            </div>
                        <?php } ?>
                    </div>

                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
            <?php include "footer.php" ?>
        </div><!-- ./wrapper -->

        <?php include './javascriptFinal.php';?>
        <script type="text/javascript" src="./recursos/js/jquery.form.min.js"></script>
        <script type="text/javascript" src="./recursos/js/ajax/Pessoa.js"></script>
        <?php
        if (isset($_GET["procurar"]) && $_GET["procurar"] != NULL && $_GET["procurar"] != "") {
            ?>
            <script>
                $(window).load(function() {
                    $("#tabs").tabs({active: 1});
                    procurarPessoa(false);
                });
            </script>
            <?php
        }
        ?> 
    </body>
</html>
<?php
/* * mascara para inputs html */

function mask($val, $mask = "(##)####-####") {
    $maskared = '';
    $k = 0;
    for ($i = 0; $i <= strlen($mask) - 1; $i++) {
        if ($mask[$i] == '#') {
            if (isset($val[$k])) {
                $maskared .= $val[$k++];
            }
        } else {
            if (isset($mask[$i])) {
                $maskared .= $mask[$i];
            }
        }
    }
    return $maskared;
}

/* * sintaxe para corrigir valor de mascara de acordo com o tamanho */

function reestruturandoTelefone($telefonepessoa2) {
    $telefone = str_replace("-", "", str_replace("(", "", str_replace(")", "", str_replace('.', '', $telefonepessoa2))));
    $telefonepessoa = trim($telefone);
    if (strlen($telefonepessoa) == 10) {
        $mascaraTelefone = "(##)####-####";
    } else {
        $mascaraTelefone = "(##)#####-####";
    }
    if (strlen($telefonepessoa) > 8 && $telefonepessoa{0} == "0") {
        $ddd = substr($telefonepessoa, 0, 3);
        if ($ddd !== "021") {
            $telefone = mask($telefonepessoa, $mascaraTelefone);
        } else {
            $telefone = mask($telefonepessoa, $mascaraTelefone);
        }
    } elseif (strlen($telefonepessoa) > 8 && $telefonepessoa{0} != "0") {
        $ddd = substr($telefonepessoa, 0, 2);
        if ($ddd !== "21") {
            $telefone = mask($telefonepessoa, $mascaraTelefone);
        } else {
            $telefone = mask($telefonepessoa, $mascaraTelefone);
        }
    } elseif (strlen($telefonepessoa) == 8) {
        $telefone = mask("21" . $telefonepessoa, $mascaraTelefone);
    }
    return $telefone;
}
