<?php
include './validacaoLogin.php';
?>
<!DOCTYPE html>
<html manifest="home.appcache"> 
    <head>
        <title><?= ($empresap["razao"]) ?> | Painel</title>
        <?php include 'head.php'; ?>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <?php include 'header.php'; ?>
            <!-- Left side column. contains the logo and sidebar -->
            <?php include "menu.php"; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Painel de controle</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">

                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <?php
                                    $qtdProdutos = $conexao->comandoArray("select count(1) as qtd from produto");
                                    echo '<h3>', $qtdProdutos["qtd"], '</h3>';
                                    echo '<p>Itens Cadastrados</p>';
                                    ?>    
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="Produto.php?procurar=1" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <?php
                                    $qtdPessoa = $conexao->comandoArray('select count(1) as qtd from pessoa');
                                    echo '<h3>', $qtdPessoa["qtd"], '</h3>';
                                    echo '<p>Usuários Registrados</p>';
                                    ?>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="Pessoa.php?procurar=1" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <?php 
                                    $menos30Dias    = date('Y-m-d', strtotime('-30 days'));
                                    $hoje           = date('Y-m-d');
                                    $qtdAquisicoes  = $conexao->comandoArray("select count(1) as qtd from produto 
                                    where produto.codproduto in(select codproduto 
                                    from valorproduto where codatributo = 15 and valor >= '{$menos30Dias}')");
                                    ?>
                                    <h3><?=$qtdAquisicoes["qtd"]?></h3>
                                    <p>Aquisições últimos 30 dias</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="Produto.php?procurar=1&dataCompra2=<?=$hoje?>&dataCompra1=<?=$menos30Dias?>" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <?php
                                    $qtdProduto = $conexao->comandoArray("select count(1) as qtd from produto 
                                    where produto.codproduto in(select codproduto 
                                    from valorproduto where codatributo = 30 and valor <> '')");
                                    echo '<h3>', $qtdProduto["qtd"], '</h3>';
                                    echo '<p>AUTO CAD</p>';
                                    ?>                                    
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="Produto.php?procurar=1&codatributo=30" class="small-box-footer">Mais informações<i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>                        
                    </div><!-- /.row -->
                    <div class="row">

                        <?php
                        $qtdProdutoCategoria = $conexao->comandoArray("select count(1) as qtd from produto where codcategoria = 1");
                        ?>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
                                <div class="info-box-content">
                                    <a href="Produto.php?procurar=1&codcategoria=1" style="color: black;">
                                        <span class="info-box-text">Total de Desktops<br> Cadastrados:</span>
                                        <span class="info-box-number"><?= $qtdProdutoCategoria["qtd"] ?></span>                                        
                                    </a>
                                </div>
                            </div>
                        </div>

                        <?php
                        $qtdProdutoCategoria = $conexao->comandoArray("select count(1) as qtd from produto where codcategoria = 2");
                        ?>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
                                <div class="info-box-content">
                                    <a href="Produto.php?procurar=1&codcategoria=2" style="color: black;">
                                        <span class="info-box-text">Total de Notebooks<br> Cadastrados:</span>
                                        <span class="info-box-number"><?= $qtdProdutoCategoria["qtd"] ?></span>                                        
                                    </a>

                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>

                        <?php
                        $qtdProdutoCategoria = $conexao->comandoArray("select count(1) as qtd from produto where codcategoria = 4");
                        ?>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
                                <div class="info-box-content">
                                    <a href="Produto.php?procurar=1&codcategoria=4" style="color: black;">
                                        <span class="info-box-text">Total de Monitores<br> Cadastrados:</span>
                                        <span class="info-box-number"><?= $qtdProdutoCategoria["qtd"] ?></span>                                        
                                    </a>

                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>

                        <?php
                        $qtdProdutoCategoria = $conexao->comandoArray("select count(1) as qtd from produto where codcategoria = 21");
                        ?>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
                                <div class="info-box-content">
                                    <a href="Produto.php?procurar=1&codcategoria=21" style="color: black;">
                                        <span class="info-box-text">Total de Impressoras<br> Cadastrados:</span>
                                        <span class="info-box-number"><?= $qtdProdutoCategoria["qtd"] ?></span>                                        
                                    </a>

                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>


                    </div>
                    
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
            <?php include 'footer.php'; ?>
        </div><!-- ./wrapper -->

        <?php include './javascriptFinal.php'; ?>

    </body>
</html>
