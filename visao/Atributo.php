<?php include "validacaoLogin.php";?>  
<!DOCTYPE html>
<html lang="pt-br" manifest="atributo.appcache">
    <head>
        <title><?= $empresap["razao"] ?> | Painel ADM.</title>
        <?php include 'head.php'; ?>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">

        <div class="wrapper">
            <?php include "header.php"; ?>
            <?php include "menu.php"; ?>
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
                            <li><a href="#tabs-1">Atributo</a></li>
                            <li><a href="#tabs-2">Atr. Categoria</a></li>
                        </ul>   
                        <div id="tabs-1"><?php include("formAtributo.php"); ?></div>
                        <div id="tabs-2"><?php include("formAtributoCategoria.php"); ?></div>
                    </div>

                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
            <?php include "footer.php" ?>
        </div><!-- ./wrapper -->

        <?php include './javascriptFinal.php'; ?>

        <script type='text/javascript' src="./recursos/js/ajax/Atributo.js"></script>   
        <script type='text/javascript' src="./recursos/js/ajax/AtributoCategoria.js"></script>   
        <?php
        if (isset($_GET["procurar"]) && $_GET["procurar"] != NULL && $_GET["procurar"] != "") {
            ?>
            <script>
                $(window).load(function() {
                    $("#tabs").tabs({active: 1});
                    procurarProduto(false);
                });
            </script>
            <?php
        }
        ?>  
    </body>
</html>
