<?php
    $sql = "select np.excluir, np.atualizar, np.inserir
    from nivelpagina as np
    where np.codnivel = {$_SESSION["codnivel"]} 
    and   np.codpagina = 99";
    $nivelpAba = $conexao->comandoArray($sql);
?>
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
                <form id="fcategoria" name="fcategoria" method="post" action='../control/SalvarCategoriaProduto.php'>
                    <input type="hidden" name="codcategoria" id="codcategoriaCategoria" value=""/>
                    <div class="col-md-6">                        
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type='text' class="form-control" name="nome" id="nomeCategoriaProduto" placeholder="Digite nome" value="">
                        </div>
                    </div>
                                      
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php 
                            if($nivelpAba["inserir"] == 1 || $nivelpAba["atualizar"] == 1){
                                echo '<input type="submit" class="btn btn-primary" value="Salvar"/> ';
                            }
                            if($nivelpAba["excluir"] == 1){
                                echo '<button style="display: none" class="btn btn-primary" id="btexcluirCategoriaProduto"   onclick="excluirCategoriaProduto()">Excluir</button>  ';
                            }
                            echo '<button class="btn btn-primary" id="btNovoCategoriaProduto"   onclick="novoCategoriaProduto()">Novo</button>  ';                            
                            ?>
                        </div>                                        
                    </div>                    
                </form>
            </div>
            <div class="row">
                <div id="listagemCategoriaProduto" class="col-md-12"></div>
            </div>
        </div>
    </div>
    <!--/.col (right) -->
</div>