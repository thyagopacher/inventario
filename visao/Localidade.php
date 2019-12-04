<?php include "validacaoLogin.php";?>  
<!DOCTYPE html>
<html lang="pt-br">
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
                            <li><a href="#tabs-1">Cidade</a></li>
                            <li><a href="#tabs-2">Estado</a></li>
                            <li><a href="#tabs-3">Local</a></li>
                            <li><a href="#tabs-4">Local Cidade</a></li>
                        </ul>   
                        <div id="tabs-1"><?php include("formCidade.php"); ?></div>
                        <div id="tabs-2"><?php include("formEstado.php"); ?></div>
                        <div id="tabs-3"><?php include("formLocal.php"); ?></div>
                        <div id="tabs-4"><?php include("formLocalCidade.php"); ?></div>
                    </div>

                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
            <?php include "footer.php" ?>
        </div><!-- ./wrapper -->

        <?php include './javascriptFinal.php'; ?>

        <script type='text/javascript' src="./recursos/js/tinymce/tinymce.min.js"></script>
        <script type='text/javascript' src="./recursos/js/Editor.js"></script>           
        <script type='text/javascript' src="./recursos/js/jquery.form.min.js"></script>   

        <script type='text/javascript' src="./recursos/js/ajax/Cidade.js"></script>   
        <script type='text/javascript' src="./recursos/js/ajax/Estado.js"></script>   
        <script type='text/javascript' src="./recursos/js/ajax/Local.js"></script>   
        <script type='text/javascript' src="./recursos/js/ajax/LocalCidade.js"></script>   
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
