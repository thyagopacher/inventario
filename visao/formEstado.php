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
                <form id="festado" name="festado" method="post" onsubmit="return false;">
                    <input type="hidden" name="codestado" id="codestado" value=""/>
                    <div class="col-md-6">                        
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type='text' class="form-control" name="nome" id="nome" placeholder="Digite nome" value="">
                        </div>
                    </div>
                    <div class="col-md-6">                        
                        <div class="form-group">
                            <label for="nome">Sigla</label>
                            <input type='text' class="form-control" name="sigla" id="sigla" placeholder="Digite sigla" value="">
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php 
                            if ($nivelp["inserir"] == 1 || $nivelp["atualizar"] == 1) {
                                echo '<input type="button" class="btn btn-primary" value="Salvar" onclick="salvarEstado()"/> ';
                            }
                            if($nivelp["excluir"] == 1){
                                echo '<button style="display: none" class="btn btn-primary" id="btexcluirEstado"   onclick="excluirEstado()">Excluir</button>  ';
                            }
                            echo '<button class="btn btn-primary" id="btNovoEstado"   onclick="novoEstado()">Novo</button>  ';                            
                            ?>
                        </div>                                        
                    </div>                    
                </form>
            </div>
            <div class="row">
                <div id="listagemEstado" class="col-md-12"></div>
            </div>
        </div>
    </div>
    <!--/.col (right) -->
</div>