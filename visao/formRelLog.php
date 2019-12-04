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
                <form method="post" action="../control/ProcurarLogRelatorio.php" name="flog" id="flog" target="_blank">
                    <input type="hidden" name="tipo" id="tipo" value="pdf"/>
                    <input type="hidden" name="codpagina" id="codpagina" value="<?= $nivelp["codpagina"] ?>"/>
                    <input type="hidden" name="codproduto" id="codproduto" value="<?=$_GET["codproduto"]?>"/>
                    <?php if(!isset($_GET["codproduto"])){?>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nome">Dt. Inicio</label>
                            <input type="text" class="form-control data" name="data1" id="data1" title="Digite data de inicio onde foi feito o cadastro">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nome">Dt. Fim</label>
                            <input type="text" class="form-control data" name="data2" id="data2" title="Digite data de fim onde foi feito o cadastro">
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
                                            $comboDepartamento .= '<option value="'. $departamento["coddepartamento"]. '">'. ($departamento["nome"]). '</option>';
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
                            <label for="observacao">Observação</label>
                            <input type="text" class="form-control" name='observacao' id="observacao" placeholder="Digite observação">
                        </div>                          
                    </div>
                    <?php }?>
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php 
                        if($nivelp["procurar"] == 1 && !isset($_GET["codproduto"])){
                            echo '<button class="btn btn-primary" type="button" onclick="procurarLog(false)">Procurar</button> ';
                        }
                        if($nivelp["gerapdf"] == 1){
                            echo '<button class="btn btn-primary" type="button" onclick="abreRelatorioLog()">Gerar PDF</button> ';
                        }
                        if($nivelp["geraexcel"] == 1){
                            echo '<button class="btn btn-primary" type="button" onclick="abreRelatorioLog2()">Gerar Excel</button> ';
                        }
                        ?>
                    </div>                                        
                </div>
            </div>
            </form>
            <div class="row">
                <div class="col-sm-12" id="listagemLog"></div>
            </div>
        </div>
    </div>
    <!--/.col (right) -->
</div>