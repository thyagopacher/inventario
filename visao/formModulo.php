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
                <form id="fmodulo" name="fmodulo" method="post"k onsubmit="return false;">
                    <input type="hidden" name="codmodulo" id="codmodulo"/>
                    <div class="col-md-6">                        
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type='text' class="form-control" name="nome" id="nome" placeholder="Digite nome" value="">
                        </div>
                    </div>
                    <div class="col-md-6">  
                        <div class="form-group">
                            <label for="nome">Titulo</label>
                            <input type='text' class="form-control" name="titulo" id="titulo" placeholder="Digite titulo" value="">
                        </div>                                       
                    </div>
                    <div class="col-md-6">  
                        <div class="form-group">
                            <label for="nome">Icone</label>
                            <input type='text' class="form-control" name="icone" id="icone" placeholder="Digite icone" value="">
                        </div>                                       
                    </div>
                </form>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php
                        if ($nivelp["inserir"] == 1 || $nivelp["atualizar"] == 1) {
                            echo '<input type="button" name="submit" id="submit" value="Salvar" class="btn btn-primary" onclick="salvarModulo()"/> ';
                        }
                        ?>
                        
                    </div>                                        
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12" id="listagemModulo"></div>
            </div>            
        </div>
    </div>
    <!--/.col (right) -->
</div>