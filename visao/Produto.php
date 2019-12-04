<?php
include "validacaoLogin.php";
if (isset($_GET["codproduto"]) && $_GET["codproduto"] != NULL && trim($_GET["codproduto"]) != "") {
    $sql = "select *
        from produto where codproduto = " . (int) $_GET["codproduto"];
    $produtop = $conexao->comandoArray($sql);
}
?>  
<!DOCTYPE html>
<html lang="pt-br" manifest="produto.appcache">
    <head>
        <title><?= ($empresap["razao"]) ?> | Painel ADM.</title>
        <?php include 'head.php'; ?>
        <style>
            .table-hover>tbody>tr:hover{
                opacity: 0.7;
            }
        </style>
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
                            <?php if ($nivelp["procurar"] == 1 || $_SESSION["codnivel"] == '1') { ?>
                                <li><a href="#tabs-1">Filtros</a></li>
                            <?php } ?>   
                            <?php if($nivelp["inserir"] == 1 || $nivelp["atualizar"] == 1 || $nivelp["excluir"] == 1){?>
                            <li><a href="#tabs-2">Cadastro</a></li>
                            <li><a href="#tabs-3">Categoria</a></li>    
                            <li><a href="#tabs-4">Status</a></li>   
                            <?php }?>
                        </ul>   
                        <?php if ($nivelp["procurar"] == 1 || $_SESSION["codnivel"] == '1') { ?>
                            <div id="tabs-1">
                                <?php include("formProcurarProduto.php"); ?>
                            </div>
                        <?php } ?>               
                        <?php if($nivelp["inserir"] == 1 || $nivelp["atualizar"] == 1 || $nivelp["excluir"] == 1){?>
                        <div id="tabs-2"><?php include("formProduto.php"); ?></div>
                        <div id="tabs-3"><?php include("formCategoriaProduto.php"); ?></div>
                        <div id="tabs-4"><?php include("formStatusProduto.php"); ?></div>
                        <?php }?>
                    </div>

                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
            <?php include "footer.php" ?>
        </div><!-- ./wrapper -->

        <?php include './javascriptFinal.php'; ?>
        <script type='text/javascript' src="./recursos/js/jquery.form.min.js"></script>   

        <script type='text/javascript' src="./recursos/js/ajax/CategoriaProduto.js"></script>   
        <script type='text/javascript' src="./recursos/js/ajax/StatusProduto.js"></script>   
        <script type='text/javascript' src="./recursos/js/ajax/Produto.js"></script>   
        <?php
        if (isset($_GET["procurar"]) && $_GET["procurar"] != NULL && $_GET["procurar"] != "") {
            ?>
            <script>
                $(window).load(function () {
                    $("#tabs").tabs({active: 0});
                    procurarProduto(false);
                });
            </script>
            <?php
        }elseif (isset($_GET["codproduto"]) && $_GET["codproduto"] != NULL && $_GET["codproduto"] != "") {
            ?>
            <script>
                $(window).load(function () {
                    $("#tabs").tabs({active: 1});
                });
            </script>
            <?php            
        }
        ?>  
    </body>
</html>
