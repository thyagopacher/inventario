<?php include "validacaoLogin.php";?>  
<!DOCTYPE html>
<html lang="pt-br" manifest="escritorio.appcache">
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
                            <li><a href="#tabs-1">Diretoria</a></li>
                            <li><a href="#tabs-2">Departamento</a></li>
                        </ul>   
                        <div id="tabs-1"><?php include("formDiretoria.php"); ?></div>
                        <div id="tabs-2"><?php include("formDepartamento.php"); ?></div>
                    </div>

                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
            <?php include "footer.php" ?>
        </div><!-- ./wrapper -->

        <?php include './javascriptFinal.php'; ?>

        <script type='text/javascript' src="./recursos/js/ajax/Departamento.js"></script>   
        <script type='text/javascript' src="./recursos/js/ajax/Diretoria.js"></script>   
       
    </body>
</html>
