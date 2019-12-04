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
                <form id="flocal" name="flocal" method="post" onsubmit="return false;">
                    <input type="hidden" name="codlocal" id="codlocal" value=""/>
                    <input type="hidden" name="codpagina" id="codpagina" value="<?=$nivelp["codpagina"]?>"/>
                    <div class="col-md-6">                        
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type='text' class="form-control" name="nome" id="nome" placeholder="Digite nome" value="">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <?php
                            if ($nivelp["inserir"] == 1 || $nivelp["atualizar"] == 1) {
                                echo '<input type="button" class="btn btn-primary" value="Salvar" onclick="salvarLocal()"/> ';
                            }
                            if($nivelp["excluir"] == 1){
                                echo '<button style="display: none" class="btn btn-primary" id="btexcluirLocal"   onclick="excluirLocal()">Excluir</button>  ';
                            }
                            echo '<button class="btn btn-primary" id="btNovoLocal"   onclick="novoLocal()">Novo</button>  ';
                            ?>
                        </div>                                        
                    </div>                    
                </form>
            </div>
            <div class="row">
                <div id="listagemLocal" class="col-md-12"></div>
            </div>
        </div>
    </div>
    <!--/.col (right) -->
</div>