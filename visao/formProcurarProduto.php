<div class="row">
    <div class="box box-default">
        <div class="box-header with-border">


            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <form action="../control/ProcurarProdutoRelatorio.php" name="fPproduto" id="fPproduto" method="post" onsubmit="return false;" target="_blank">
                    <input type="hidden" name="tipo" id="tipo" value="pdf"/>
                    <input type="hidden" name="codpagina" id="codpagina" value="<?=$nivelp["codpagina"]?>"/>
                    <input type="hidden" name="procurar_menu" id="procurar_menu" value="<?php
                    if (isset($_POST["procurar_menu"])) {
                        echo $_POST["procurar_menu"];
                    }
                    ?>"/>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nome">Dt. Inicio Cad.</label>
                            <input type="text" class="form-control data" name="data1" id="data1">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nome">Dt. Fim Cad.</label>
                            <input type="text" class="form-control data" name="data2" id="data2">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nome">Dt. Inicio Compra</label>
                            <input type="text" class="form-control data" name="dataCompra1" id="dataCompra1" value="<?php if (isset($_GET["dataCompra1"])) {
                        echo $_GET["dataCompra1"];
                    } ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nome">Dt. Fim Compra</label>
                            <input type="text" class="form-control data" name="dataCompra2" id="dataCompra2" value="<?php if (isset($_GET["dataCompra2"])) {
                        echo $_GET["dataCompra2"];
                    } ?>">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="cidade">Nome</label>
                            <input type='text' class="form-control" name="nome" id="nome" placeholder="Digite nome produto">
                        </div>                             
                    </div><!-- /.col -->

                    <div class="col-md-3">                        
                        <div class="form-group">
                            <label for="nome">Atributo</label>
                            <select class="form-control" name="codatributo" id="codatributo">
                                <?php
                                $resatributo = $conexao->comando('select codatributo, nome from atributo order by nome');
                                $qtdatributo = $conexao->qtdResultado($resatributo);
                                if ($qtdatributo > 0) {
                                    $comboAtributo .= '<option value="">--Selecione--</option>';
                                    while ($atributo = $conexao->resultadoArray($resatributo)) {
                                        if (isset($_GET["codatributo"]) && $_GET["codatributo"] != NULL && $_GET["codatributo"] == $atributo["codatributo"]) {
                                            $comboAtributo .= '<option selected value="' . $atributo["codatributo"] . '">' . ($atributo["nome"]) . '</option>';
                                        } else {
                                            $comboAtributo .= '<option value="' . $atributo["codatributo"] . '">' . ($atributo["nome"]) . '</option>';
                                        }
                                    }
                                } else {
                                    $comboAtributo .= '<option value="">--Nada encontrado--</option>';
                                }

                                echo $comboAtributo;
                                ?>
                            </select>
                        </div>
                    </div> 
                    
                    <div class="col-md-3">                        
                        <div class="form-group">
                            <label for="nome">Categoria</label>
                            <select class="form-control" name="codcategoria" id="codcategoria">
                                <?php
                                $rescategoria = $conexao->comando('select codcategoria, nome from categoriaproduto as categoria order by nome');
                                $qtdcategoria = $conexao->qtdResultado($rescategoria);
                                if ($qtdcategoria > 0) {
                                    $comboCategoria .= '<option value="">--Selecione--</option>';
                                    while ($categoria = $conexao->resultadoArray($rescategoria)) {
                                        if (isset($_GET["codcategoria"]) && $_GET["codcategoria"] != NULL && $_GET["codcategoria"] == $categoria["codcategoria"]) {
                                            $comboCategoria .= '<option selected value="' . $categoria["codcategoria"] . '">' . ($categoria["nome"]) . '</option>';
                                        } else {
                                            $comboCategoria .= '<option value="' . $categoria["codcategoria"] . '">' . ($categoria["nome"]) . '</option>';
                                        }
                                    }
                                } else {
                                    $comboCategoria .= '<option value="">--Nada encontrado--</option>';
                                }

                                echo $comboCategoria;
                                ?>
                            </select>
                        </div>
                    </div>                   
                    <div class="col-md-3">                        
                        <div class="form-group">
                            <label for="nome">Status</label>
                            <select class="form-control" name="codstatus" id="codstatus">
                                <?php
                                $comboStatus = $cache->read('comboStatus');
                                if (!isset($comboStatus) || $comboStatus == NULL) {
                                    $resstatus = $conexao->comando('select codstatus, nome from statusproduto as status order by nome');
                                    $qtdstatus = $conexao->qtdResultado($resstatus);
                                    if ($qtdstatus > 0) {
                                        $comboStatus .= '<option value="">--Selecione--</option>';
                                        while ($status = $conexao->resultadoArray($resstatus)) {
                                            $comboStatus .= '<option value="' . $status["codstatus"] . '">' . ($status["nome"]) . '</option>';
                                        }
                                    } else {
                                        $comboStatus .= '<option value="">--Nada encontrado--</option>';
                                    }
                                    $cache->save('comboStatus', $comboStatus, '180 minutes');
                                }
                                echo $comboStatus;
                                ?>
                            </select>
                        </div>
                    </div>                   
                    <div class="col-md-3">                        
                        <div class="form-group">
                            <label for="nome">Departamento</label>
                            <select class="form-control" name="coddepartamento" id="coddepartamento">
                                <?php
                                $comboDepartamento = $cache->read('comboDepartamento');
                                if (!isset($comboDepartamento) || $comboDepartamento == NULL) {
                                    $resdepartamento = $conexao->comando('select coddepartamento, nome from departamento order by nome');
                                    $qtddepartamento = $conexao->qtdResultado($resdepartamento);
                                    if ($qtddepartamento > 0) {
                                        $comboDepartamento .= '<option value="">--Selecione--</option>';
                                        while ($departamento = $conexao->resultadoArray($resdepartamento)) {
                                            $comboDepartamento .= '<option value="' . $departamento["coddepartamento"] . '">' . ($departamento["nome"]) . '</option>';
                                        }
                                    } else {
                                        $comboDepartamento .= '<option value="">--Nada encontrado--</option>';
                                    }
                                    $cache->save('comboDepartamento', $comboDepartamento, '180 minutes');
                                }
                                echo $comboDepartamento;
                                ?>
                            </select>
                        </div>
                    </div>                   
                    <div class="col-md-3">                        
                        <div class="form-group">
                            <label for="nome">Diretoria</label>
                            <select class="form-control" name="coddiretoria" id="coddiretoria">
                                <?php
                                $comboDiretoria = $cache->read('comboDiretoria');
                                if (!isset($comboDiretoria) || $comboDiretoria == NULL) {
                                    $resdiretoria = $conexao->comando('select coddiretoria, nome from diretoria order by nome');
                                    $qtddiretoria = $conexao->qtdResultado($resdiretoria);
                                    if ($qtddiretoria > 0) {
                                        $comboDiretoria .= '<option value="">--Selecione--</option>';
                                        while ($diretoria = $conexao->resultadoArray($resdiretoria)) {
                                            $comboDiretoria .= '<option value="' . $diretoria["coddiretoria"] . '">' . ($diretoria["nome"]) . '</option>';
                                        }
                                    } else {
                                        $comboDiretoria .= '<option value="">--Nada encontrado--</option>';
                                    }
                                    $cache->save('comboDiretoria', $comboDiretoria, '180 minutes');
                                }
                                echo $comboDiretoria;
                                ?>
                            </select>
                        </div>
                    </div>                   
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php
                            if($nivelp["procurar"] == 1){
                                echo '<button class="btn btn-primary" type="button" onclick="procurarProduto(false)">Procurar</button> ';
                            }
                            if($nivelp["gerapdf"] == 1){
                                echo '<button class="btn btn-primary" type="button" onclick="abreRelatorioProduto()">Gerar PDF</button> ';
                            }
                            if($nivelp["geraexcel"] == 1){
                                echo '<button class="btn btn-primary" type="button" onclick="abreRelatorioProduto2()">Gerar Excel</button> ';
                            }
                        ?>
                    </div>                                        
                </div>
            </div>
            </form>
            <div class="row">
                <div class="col-sm-12" id="listagemProduto"></div>
            </div>
        </div>
    </div>
    <!--/.col (right) -->
</div>