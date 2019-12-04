<?php
include "validacaoLogin.php";

$empresaf = $cache->read('empresaf');
if(!isset($empresaf) || $empresaf == NULL){
    $empresaf = $conexao->comandoArray("select * from empresa where codempresa = ".(int)$_SESSION["codempresa"]);
    $cache->save('empresaf', $empresaf, '180 minutes');
}

$action = "../control/SalvarEmpresa.php";
$titulo = "Nossa Empresa";
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?=($empresaf["razao"])?> | <?= $titulo ?></title>
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
                        </ul>   
                        <div id="tabs-1"><?php include "formEmpresa.php";?></div>
                    </div>                    
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
            <?php include "footer.php"?>

        </div><!-- ./wrapper -->

        <?php include './javascriptFinal.php';?>
        <script type="text/javascript" src="./recursos/js/jquery.form.min.js"></script>
        <script type="text/javascript" src="./recursos/js/ajax/Empresa.js"></script>
             
    </body>
</html>
