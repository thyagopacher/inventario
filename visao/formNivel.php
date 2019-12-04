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
                <form id="fnivel" name="fnivel" method="post" onsubmit="return false;">
                    <input type="hidden" name="codnivel" id="codnivel" value="<?=$_GET["codnivel"]?>"/>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type='text' class="form-control" name="nome" id="nome" placeholder="Digite nome" value="<?php if(isset($nivel["nome"]) && $nivel["nome"] != NULL && $nivel["nome"] != ""){echo $nivel["nome"];}?>">
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
                            echo '<input type="button" name="submit" id="submit" value="Salvar" class="btn btn-primary" onclick="salvarNivel();"/> ';
                        }
                        ?>
                        
                    </div>                                        
                </div>
            </div>
        </div>
    </div>
    <!--/.col (right) -->
</div>