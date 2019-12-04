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
                <form method="post" action="../control/ProcurarPessoaRelatorio.php" name="fPpessoa" id="fPpessoa" target="_blank">
                    <input type="hidden" name="tipo" id="tipo" value="pdf"/>
                    <input type="hidden" name="codpagina" id="codpagina" value="<?=$nivelp["codpagina"]?>"/>
                    <?php if ($ehCliente == "s") { ?>
                        <input type="hidden" name="ehCliente" id="ehCliente" value="s"/>
                    <?php } ?>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nome">Dt. Inicio</label>
                            <input type="text" class="form-control data" name="data1" id="data1">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nome">Dt. Fim</label>
                            <input type="text" class="form-control data" name="data2" id="data2">
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control" name='email' id="email" placeholder="Digite e-mail">
                        </div>                          
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" name='nome' placeholder="Digite nome">
                        </div>                          
                    </div>

            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php
                            if($nivelp["procurar"] == 1){
                                echo '<button class="btn btn-primary" type="button" onclick="procurarPessoa(false)">Procurar</button> ';
                            }
                            if($nivelp["gerapdf"] == 1){
                                echo '<button class="btn btn-primary" type="button" onclick="abreRelatorioPessoa()">Gerar PDF</button> ';
                            }
                            if($nivelp["geraexcel"] == 1){
                                echo '<button class="btn btn-primary" type="button" onclick="abreRelatorioPessoa2()">Gerar Excel</button> ';
                            }
                        ?>
                    </div>                                        
                </div>
            </div>
            </form>
            <div class="row">
                <div class="col-sm-12" id="listagemPessoa"></div>
            </div>
        </div>
    </div>
    <!--/.col (right) -->
</div>